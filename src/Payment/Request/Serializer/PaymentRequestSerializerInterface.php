<?php

declare(strict_types=1);

namespace App\Payment\Request\Serializer;

use App\Payment\Request\NewPaymentRequestInterface;
use App\Payment\Request\Serializer\Result\PaymentRequestSerializerResultInterface;

interface PaymentRequestSerializerInterface
{
    public function serializeNewPaymentRequest(NewPaymentRequestInterface $newPaymentRequest): string;

    public function unserializeNewPaymentRequest(string $serializedData): PaymentRequestSerializerResultInterface;
}
