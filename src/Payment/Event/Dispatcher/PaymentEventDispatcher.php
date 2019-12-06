<?php

declare(strict_types=1);

namespace App\Payment\Event\Dispatcher;

use App\Payment\Event\CallbackPaymentEvent;
use App\Payment\Request\CallbackPaymentRequestInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class PaymentEventDispatcher implements PaymentEventDispatcherInterface
{
    private $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function dispatchCallbackEvent(CallbackPaymentRequestInterface $request)
    {
        $this->eventDispatcher->dispatch(new CallbackPaymentEvent($request));
    }
}
