<?php

declare(strict_types=1);

namespace App\Payment\Event;

use App\Payment\Request\CallbackPaymentRequestInterface;

interface CallbackPaymentEventInterface
{
    public function getRequest(): CallbackPaymentRequestInterface;
}
