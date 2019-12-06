<?php

declare(strict_types=1);

namespace App\Payment\Request\Serializer\Result;

use App\Payment\Request\NewPaymentRequestInterface;
use App\Result\ResultInterface;

interface PaymentRequestSerializerResultInterface extends ResultInterface
{
    public function getRequest(): NewPaymentRequestInterface;
}
