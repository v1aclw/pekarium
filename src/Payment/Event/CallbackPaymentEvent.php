<?php

declare(strict_types=1);

namespace App\Payment\Event;

use App\Payment\Request\CallbackPaymentRequestInterface;
use Symfony\Contracts\EventDispatcher\Event;

class CallbackPaymentEvent extends Event implements CallbackPaymentEventInterface
{
    private $request;

    public function __construct(CallbackPaymentRequestInterface $request)
    {
        $this->request = $request;
    }

    public function getRequest(): CallbackPaymentRequestInterface
    {
        return $this->request;
    }
}
