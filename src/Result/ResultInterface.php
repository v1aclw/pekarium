<?php

declare(strict_types=1);

namespace App\Result;

use App\Error\ErrorInterface;

interface ResultInterface
{
    public const FIELD_ERROR = 'error';

    public function getError(): ?ErrorInterface;
}
