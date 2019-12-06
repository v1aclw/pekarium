<?php

declare(strict_types=1);

namespace App\Card;

interface CardInterface
{
    public const FIELD_NUMBER = 'number';
    public const FIELD_PAYABLE = 'payable';

    public function getNumber(): string;

    public function isPayable(): bool;
}
