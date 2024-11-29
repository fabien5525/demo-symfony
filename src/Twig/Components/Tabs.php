<?php

// src/Twig/Components/Alert.php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Tabs
{
    public string $route;
    /** @var array<int<0, max>, array<int<0, max>, string|bool>> */
    public array $routes;
}
