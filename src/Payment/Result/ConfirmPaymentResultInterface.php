<?php

declare(strict_types=1);

namespace App\Payment\Result;

use App\Result\ResultInterface;

interface ConfirmPaymentResultInterface extends ResultInterface, \JsonSerializable
{

}
