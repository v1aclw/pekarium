<?php

declare(strict_types=1);

namespace App\Dictionary;

class ErrorCodeDictionary
{
    public const VALIDATION_ERROR = 'app.validation_error';
    public const CANNOT_UNSERIALIZE_NEW_PAYMENT_REQUEST = 'app.payment.request.new.serializer.cannot_unserialize';
    public const CARD_NOT_FOUND = 'app.card.not_found';
}
