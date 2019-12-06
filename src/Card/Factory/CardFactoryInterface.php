<?php

declare(strict_types=1);

namespace App\Card\Factory;

use App\Card\CardInterface;

interface CardFactoryInterface
{
    public function create(string $number, bool $payable): CardInterface;

    public function createFromData(array $cardData): CardInterface;
}
