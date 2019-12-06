<?php

declare(strict_types=1);

namespace App\Payment\Result;

use App\Result\ErrorResult;

class ErrorNewPaymentResult extends ErrorResult implements NewPaymentResultInterface
{
    public function getUrl(): string
    {
        return '';
    }
}
