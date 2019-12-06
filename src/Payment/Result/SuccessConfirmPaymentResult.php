<?php

declare(strict_types=1);

namespace App\Payment\Result;

use App\Error\ErrorInterface;

class SuccessConfirmPaymentResult implements ConfirmPaymentResultInterface
{
    public function getError(): ?ErrorInterface
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array
    {
        return [];
    }
}
