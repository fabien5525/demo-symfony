<?php

// src/Twig/Components/Alert.php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Pagination
{
    public int $currentPage;
    public int $offset;
    public int $limit;
    public int $total;
}
