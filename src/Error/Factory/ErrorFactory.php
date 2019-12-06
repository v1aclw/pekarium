<?php

declare(strict_types=1);

namespace App\Error\Factory;

use App\Error\Error;
use App\Error\ErrorInterface;

class ErrorFactory implements ErrorFactoryInterface
{
    public function createError(string $code, array $data = []): ErrorInterface
    {
        return new Error($code, $data);
    }
}
