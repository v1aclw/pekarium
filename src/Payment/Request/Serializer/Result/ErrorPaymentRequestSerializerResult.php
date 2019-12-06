<?php

declare(strict_types=1);

namespace App\Payment\Request\Serializer\Result;

use App\Payment\Request\NewPaymentRequestInterface;
use App\Result\ErrorResult;

class ErrorPaymentRequestSerializerResult extends ErrorResult implements PaymentRequestSerializerResultInterface
{
    public function getRequest(): NewPaymentRequestInterface
    {
        return null;
    }
}
