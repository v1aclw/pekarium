<?php

declare(strict_types=1);

namespace App\Payment\Request\Factory;

use App\Payment\Request\CallbackPaymentRequest;
use App\Payment\Request\CallbackPaymentRequestInterface;
use App\Payment\Request\ConfirmPaymentRequest;
use App\Payment\Request\ConfirmPaymentRequestInterface;
use App\Payment\Request\NewPaymentRequest;
use App\Payment\Request\NewPaymentRequestInterface;

class PaymentRequestFactory implements PaymentRequestFactoryInterface
{
    public function createNewPaymentRequest(
        float $amount,
        string $currencyCode,
        string $callbackUrl,
        string $redirectUrl
    ): NewPaymentRequestInterface {
        return new NewPaymentRequest($amount, $currencyCode, $callbackUrl, $redirectUrl);
    }

    public function createConfirmPaymentRequest(
        string $number,
        string $holder,
        int $cvv,
        int $expirationMonth,
        int $expirationYear
    ): ConfirmPaymentRequestInterface {
        return new ConfirmPaymentRequest($number, $holder, $cvv, $expirationMonth, $expirationYear);
    }

    public function createCallbackPaymentRequest(
        string $status,
        NewPaymentRequestInterface $newPaymentRequest
    ): CallbackPaymentRequestInterface {
        return new CallbackPaymentRequest($status, $newPaymentRequest);
    }
}
