<?php

declare(strict_types=1);

namespace App\Card\Factory;

use App\Card\Card;
use App\Card\CardInterface;

class CardFactory implements CardFactoryInterface
{
    public function create(string $number, bool $payable): CardInterface
    {
        return new Card($number, $payable);
    }

    public function createFromData(array $cardData): CardInterface
    {
        return $this->create(
            (string)$cardData[CardInterface::FIELD_NUMBER],
            (bool)$cardData[CardInterface::FIELD_PAYABLE]
        );
    }
}
