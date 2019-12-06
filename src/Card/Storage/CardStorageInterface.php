<?php

declare(strict_types=1);

namespace App\Card\Storage;

use App\Card\CardInterface;

interface CardStorageInterface
{
    /**
     * @return \Generator|CardInterface[]
     */
    public function getAll(): \Generator;
}
