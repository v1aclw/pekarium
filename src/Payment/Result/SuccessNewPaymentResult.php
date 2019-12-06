<?php

declare(strict_types=1);

namespace App\Payment\Result;

use App\Error\ErrorInterface;

class SuccessNewPaymentResult implements NewPaymentResultInterface
{
    private $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function getError(): ?ErrorInterface
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            self::FIELD_URL => $this->url
        ];
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
