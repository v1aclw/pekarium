<?php

declare(strict_types=1);

namespace App\Result;

use App\Error\ErrorInterface;

class ErrorResult implements ResultInterface, \JsonSerializable
{
    protected $error;

    public function __construct(ErrorInterface $error)
    {
        $this->error = $error;
    }

    public function getError(): ?ErrorInterface
    {
        return $this->error;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array
    {
        return [
            self::FIELD_ERROR => $this->error
        ];
    }
}
