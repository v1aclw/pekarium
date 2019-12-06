<?php

declare(strict_types=1);

namespace App\Payment\Request;

interface ConfirmPaymentRequestInterface
{
    public const FIELD_NUMBER = 'number';
    public const FIELD_HOLDER = 'holder';
    public const FIELD_CVV = 'cvv';
    public const FIELD_EXPIRATION_MONTH = 'expiration_month';
    public const FIELD_EXPIRATION_YEAR = 'expiration_year';

    public function getNumber(): string;

    public function getHolder(): string;

    public function getCvv(): int;

    public function getExpirationMonth(): int;

    public function getExpirationYear(): int;
}
