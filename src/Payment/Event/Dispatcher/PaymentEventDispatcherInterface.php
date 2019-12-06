<?php

declare(strict_types=1);

namespace App\Payment\Event\Dispatcher;

use App\Payment\Request\CallbackPaymentRequestInterface;

interface PaymentEventDispatcherInterface
{
    public function dispatchCallbackEvent(CallbackPaymentRequestInterface $request);
}
