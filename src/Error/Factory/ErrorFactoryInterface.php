<?php

declare(strict_types=1);

namespace App\Error\Factory;

use App\Error\ErrorInterface;

interface ErrorFactoryInterface
{
    public function createError(string $code, array $data = []): ErrorInterface;
}
