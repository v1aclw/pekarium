<?php

declare(strict_types=1);

namespace App\Payment\Request;

class NewPaymentRequest implements NewPaymentRequestInterface
{
    private $amount;
    private $currencyCode;
    private $callbackUrl;
    private $redirectUrl;

    public function __construct(
        float $amount,
        string $currencyCode,
        string $callbackUrl,
        string $redirectUrl
    ) {
        $this->amount = $amount;
        $this->currencyCode = $currencyCode;
        $this->callbackUrl = $callbackUrl;
        $this->redirectUrl = $redirectUrl;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    public function getCallbackUrl(): string
    {
        return $this->callbackUrl;
    }

    public function getRedirectUrl(): string
    {
        return $this->redirectUrl;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            self::FIELD_AMOUNT => $this->amount,
            self::FIELD_CURRENCY_CODE => $this->currencyCode,
            self::FIELD_CALLBACK_URL => $this->callbackUrl,
            self::FIELD_REDIRECT_URL => $this->redirectUrl
        ];
    }
}
