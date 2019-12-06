<?php

declare(strict_types=1);

namespace App\Payment\Service;

use App\Payment\Request\ConfirmPaymentRequestInterface;
use App\Payment\Request\NewPaymentRequestInterface;
use App\Payment\Result\ConfirmPaymentResultInterface;
use App\Payment\Result\NewPaymentResultInterface;

interface PaymentServiceInterface
{
    public function new(NewPaymentRequestInterface $request): NewPaymentResultInterface;

    public function confirm(
        NewPaymentRequestInterface $newPaymentRequest,
        ConfirmPaymentRequestInterface $confirmPaymentRequest
    ): ConfirmPaymentResultInterface;
}
