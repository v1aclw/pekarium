<?php

declare(strict_types=1);

namespace App\Card\Filter\Factory;

use App\Card\Filter\CardFilter;
use App\Card\Filter\CardFilterInterface;

class CardFilterFactory implements CardFilterFactoryInterface
{
    public function create(string $number): CardFilterInterface
    {
        return new CardFilter($number);
    }
}
