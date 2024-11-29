<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;

abstract class TrackedCommand extends Command
{
    private string $uniqueId;

    public function __construct(?string $name = null)
    {
        parent::__construct($name);
        $this->uniqueId = uniqid();
    }

    public function getUniqueId(): string
    {
        return $this->uniqueId;
    }
}
