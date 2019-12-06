<?php

declare(strict_types=1);

namespace App\Card\Filter\Factory;

use App\Card\Filter\CardFilterInterface;

interface CardFilterFactoryInterface
{
    public function create(string $number): CardFilterInterface;
}
