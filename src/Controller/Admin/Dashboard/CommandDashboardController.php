<?php

namespace App\Controller\Admin\Dashboard;

use App\Entity\LogCommand;
use App\Repository\LogCommandRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

#[Route('/admin/dashboard/command', name: 'admin_dashboard_command_')]
class CommandDashboardController extends AbstractController
{
    public const int TABLE_LIMIT = 10;

    #[Route('/{page}', name: 'index', requirements: ['page' => Requirement::POSITIVE_INT], defaults: ['page' => 1], methods: ['GET'])]
    public function index(
        LogCommandRepository $logCommandRepository,
        int $page = 1,
    ): Response {
        $limit = self::TABLE_LIMIT;
        $offset = ($page - 1) * $limit;

        return $this->render('admin/dashboard/command/index.html.twig', [
            'logCommands' => $logCommandRepository->findBy([], ['beginAt' => 'DESC'], $limit, $offset),
            'current_page' => $page,
            'offset' => $offset,
            'limit' => $limit,
            'total' => $logCommandRepository->count(),
        ]);
    }

    #[Route('/read/{id}', name: 'read', requirements: ['id' => Requirement::POSITIVE_INT], methods: ['GET'])]
    public function read(LogCommand $logCommand): Response
    {
        return $this->render('admin/dashboard/command/partials/_read.html.twig', [
            'logCommand' => $logCommand,
        ]);
    }
}
