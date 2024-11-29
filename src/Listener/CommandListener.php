<?php

namespace App\Listener;

use App\Command\TrackedCommand;
use App\Entity\LogCommand;
use App\Repository\LogCommandRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\Console\Event\ConsoleErrorEvent;
use Symfony\Component\Console\Event\ConsoleTerminateEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: ConsoleCommandEvent::class)]
#[AsEventListener(event: ConsoleErrorEvent::class)]
#[AsEventListener(event: ConsoleTerminateEvent::class)]
readonly class CommandListener
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private LogCommandRepository $logCommandRepository,
    ) {
    }

    public function __invoke(ConsoleCommandEvent|ConsoleErrorEvent|ConsoleTerminateEvent $event): void
    {
        $command = $event->getCommand();
        if (!$command instanceof TrackedCommand) {
            return;
        }

        $name = $command->getName() ?? 'Unknown';
        $commandId = $command->getUniqueId();

        if ($event instanceof ConsoleCommandEvent) {
            $logCommand = (new LogCommand())
                ->setName($name)
                ->setBeginAt(microtime(true))
                ->setUniqueId($commandId);
            $this->entityManager->persist($logCommand);
        } elseif ($event instanceof ConsoleErrorEvent) {
            $logCommand = $this->logCommandRepository->findOneBy(['uniqueId' => $commandId]);
            if (!$logCommand) {
                throw new \RuntimeException('Log command not found - '.$commandId);
            }

            $error = $event->getError();
            $errors = [];
            while ($error) {
                $errors[] = [
                    'message' => $error->getMessage(),
                    'code' => $error->getCode(),
                    'file' => $error->getFile(),
                    'line' => $error->getLine(),
                    'trace' => $error->getTrace(),
                ];
                $error = $error->getPrevious();
            }
            $logCommand->setEndAt(microtime(true))
                ->setStatus($event->getExitCode())
                ->setErrors($errors);
        } else {
            $logCommand = $this->logCommandRepository->findOneBy(['uniqueId' => $commandId]);
            if (!$logCommand) {
                throw new \RuntimeException('Log command not found - '.$commandId);
            }
            $logCommand->setEndAt(microtime(true))
                ->setStatus($event->getExitCode());
        }
        $this->entityManager->flush();
    }
}
