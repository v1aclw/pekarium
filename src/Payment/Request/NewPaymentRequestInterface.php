<?php

declare(strict_types=1);

namespace App\Payment\Request;

interface NewPaymentRequestInterface extends \JsonSerializable
{
    public const FIELD_AMOUNT = 'amount';
    public const FIELD_CURRENCY_CODE = 'currency_code';
    public const FIELD_CALLBACK_URL = 'success_url';
    public const FIELD_REDIRECT_URL = 'redirect_url';

    public function getAmount(): float;

    public function getCurrencyCode(): string;

    public function getCallbackUrl(): string;

    public function getRedirectUrl(): string;
}
