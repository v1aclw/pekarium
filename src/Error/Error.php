<?php

declare(strict_types=1);

namespace App\Error;

class Error implements ErrorInterface
{
    private $code;
    private $data;

    public function __construct(string $code, array $data = [])
    {
        $this->code = $code;
        $this->data = $data;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array
    {
        return [
            self::FIELD_CODE => $this->code,
            self::FIELD_DATA => $this->data
        ];
    }
}
