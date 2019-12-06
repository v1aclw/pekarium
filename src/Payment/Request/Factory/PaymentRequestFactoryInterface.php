<?php

declare(strict_types=1);

namespace App\Payment\Request\Factory;

use App\Payment\Request\CallbackPaymentRequestInterface;
use App\Payment\Request\ConfirmPaymentRequestInterface;
use App\Payment\Request\NewPaymentRequestInterface;

interface PaymentRequestFactoryInterface
{
    public function createNewPaymentRequest(
        float $amount,
        string $currencyCode,
        string $callbackUrl,
        string $redirectUrl
    ): NewPaymentRequestInterface;

    public function createConfirmPaymentRequest(
        string $number,
        string $holder,
        int $cvv,
        int $expirationMonth,
        int $expirationYear
    ): ConfirmPaymentRequestInterface;

    public function createCallbackPaymentRequest(
        string $status,
        NewPaymentRequestInterface $newPaymentRequest
    ): CallbackPaymentRequestInterface;
}
