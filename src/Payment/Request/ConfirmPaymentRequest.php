<?php

declare(strict_types=1);

namespace App\Payment\Request;

class ConfirmPaymentRequest implements ConfirmPaymentRequestInterface
{
    private $number;
    private $holder;
    private $cvv;
    private $expirationMonth;
    private $expirationYear;

    public function __construct(string $number, string $holder, int $cvv, int $expirationMonth, int $expirationYear)
    {
        $this->number = $number;
        $this->holder = $holder;
        $this->cvv = $cvv;
        $this->expirationMonth = $expirationMonth;
        $this->expirationYear = $expirationYear;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getHolder(): string
    {
        return $this->holder;
    }

    public function getCvv(): int
    {
        return $this->cvv;
    }

    public function getExpirationMonth(): int
    {
        return $this->expirationMonth;
    }

    public function getExpirationYear(): int
    {
        return $this->expirationYear;
    }
}
