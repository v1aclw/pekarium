<?php

declare(strict_types=1);

namespace App\Card\Filter;

use App\Card\CardInterface;

class CardFilter implements CardFilterInterface
{
    private $number;

    public function __construct(string $number)
    {
        $this->number = $number;
    }

    /**
     * @inheritDoc
     */
    public function filter(iterable $cards): \Generator
    {
        foreach ($cards as $card) {
            if ($this->number === $card->getNumber()) {
                yield $card;
            }
        }
    }
}
