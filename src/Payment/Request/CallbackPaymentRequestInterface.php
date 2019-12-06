<?php

declare(strict_types=1);

namespace App\Payment\Request;

interface CallbackPaymentRequestInterface extends \JsonSerializable
{
    public const STATUS_SUCCESS = 'success';
    public const STATUS_FAILED = 'failed';

    public const FIELD_STATUS = 'status';
    public const FIELD_REQUEST = 'request';

    public function getStatus(): string;

    public function getRequest(): NewPaymentRequestInterface;
}
