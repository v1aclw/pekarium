<?php

declare(strict_types=1);

namespace App\Payment\Request\Serializer\Result;

use App\Error\ErrorInterface;
use App\Payment\Request\NewPaymentRequestInterface;

class SuccessPaymentRequestSerializerResult implements PaymentRequestSerializerResultInterface
{
    /**
     * @var NewPaymentRequestInterface
     */
    private $request;

    public function __construct(NewPaymentRequestInterface $request)
    {
        $this->request = $request;
    }

    public function getError(): ?ErrorInterface
    {
        return null;
    }

    public function getRequest(): NewPaymentRequestInterface
    {
        return $this->request;
    }
}
