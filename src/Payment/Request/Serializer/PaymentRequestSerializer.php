<?php

declare(strict_types=1);

namespace App\Payment\Request\Serializer;

use App\Dictionary\ErrorCodeDictionary;
use App\Error\Factory\ErrorFactoryInterface;
use App\Form\Error\Factory\FormErrorFactoryInterface;
use App\Form\Type\NewPaymentRequestType;
use App\Payment\Request\NewPaymentRequestInterface;
use App\Payment\Request\Serializer\Result\ErrorPaymentRequestSerializerResult;
use App\Payment\Request\Serializer\Result\PaymentRequestSerializerResultInterface;
use App\Payment\Request\Serializer\Result\SuccessPaymentRequestSerializerResult;
use Symfony\Component\Form\FormFactoryInterface;

class PaymentRequestSerializer implements PaymentRequestSerializerInterface
{
    private $errorFactory;
    private $formFactory;
    private $formErrorFactory;

    public function __construct(
        ErrorFactoryInterface $errorFactory,
        FormFactoryInterface $formFactory,
        FormErrorFactoryInterface $formErrorFactory
    ) {
        $this->errorFactory = $errorFactory;
        $this->formFactory = $formFactory;
        $this->formErrorFactory = $formErrorFactory;
    }

    public function serializeNewPaymentRequest(NewPaymentRequestInterface $newPaymentRequest): string
    {
        return base64_encode(json_encode($newPaymentRequest));
    }

    public function unserializeNewPaymentRequest(string $serializedData): PaymentRequestSerializerResultInterface
    {
        if (false === $jsonData = base64_decode($serializedData)) {
            return new ErrorPaymentRequestSerializerResult(
                $this->errorFactory->createError(ErrorCodeDictionary::CANNOT_UNSERIALIZE_NEW_PAYMENT_REQUEST)
            );
        }

        $decodedData = json_decode($jsonData, true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            return new ErrorPaymentRequestSerializerResult(
                $this->errorFactory->createError(
                    ErrorCodeDictionary::CANNOT_UNSERIALIZE_NEW_PAYMENT_REQUEST,
                    [
                        'message' => json_last_error_msg()
                    ]
                )
            );
        }

        $form = $this->formFactory->create(NewPaymentRequestType::class);
        $form->submit($decodedData);

        if (false === $form->isValid()) {
            return new ErrorPaymentRequestSerializerResult($this->formErrorFactory->createFromForm($form));
        }

        return new SuccessPaymentRequestSerializerResult($form->getData());
    }
}
