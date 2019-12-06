<?php

declare(strict_types=1);

namespace App\Card\Filter;

use App\Card\CardInterface;

interface CardFilterInterface
{
    /**
     *
     * @param iterable|CardInterface[] $cards
     * @return \Generator|CardInterface[]
     */
    public function filter(iterable $cards): \Generator;
}
