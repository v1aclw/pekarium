<?php

declare(strict_types=1);

namespace App\Card;

class Card implements CardInterface
{
    private $number;
    private $payable;

    public function __construct(string $number, bool $payable)
    {
        $this->number = $number;
        $this->payable = $payable;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function isPayable(): bool
    {
        return $this->payable;
    }
}
