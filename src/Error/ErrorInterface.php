<?php

declare(strict_types=1);

namespace App\Error;

interface ErrorInterface extends \JsonSerializable
{
    public const FIELD_CODE = 'code';
    public const FIELD_DATA = 'data';

    public function getCode(): string;

    public function getData(): array;
}
