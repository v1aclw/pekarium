<?php

declare(strict_types=1);

namespace App\Payment\Result;

use App\Result\ResultInterface;

interface NewPaymentResultInterface extends ResultInterface, \JsonSerializable
{
    public const FIELD_URL = 'url';

    public function getUrl(): string;
}
