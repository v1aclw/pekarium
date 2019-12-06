<?php

declare(strict_types=1);

namespace App\Payment\Request;

class CallbackPaymentRequest implements CallbackPaymentRequestInterface
{
    private $status;
    private $request;

    public function __construct(string $status, NewPaymentRequestInterface $request)
    {
        $this->status = $status;
        $this->request = $request;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getRequest(): NewPaymentRequestInterface
    {
        return $this->request;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array
    {
        return [
            self::FIELD_STATUS => $this->status,
            self::FIELD_REQUEST => $this->request
        ];
    }
}
