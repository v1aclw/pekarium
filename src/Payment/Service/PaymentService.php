<?php

declare(strict_types=1);

namespace App\Payment\Service;

use App\Card\CardInterface;
use App\Card\Filter\Factory\CardFilterFactoryInterface;
use App\Card\Storage\CardStorageInterface;
use App\Dictionary\ErrorCodeDictionary;
use App\Error\Factory\ErrorFactoryInterface;
use App\Payment\Event\Dispatcher\PaymentEventDispatcherInterface;
use App\Payment\Request\CallbackPaymentRequestInterface;
use App\Payment\Request\ConfirmPaymentRequestInterface;
use App\Payment\Request\Factory\PaymentRequestFactoryInterface;
use App\Payment\Request\NewPaymentRequestInterface;
use App\Payment\Request\Serializer\PaymentRequestSerializerInterface;
use App\Payment\Result\ConfirmPaymentResultInterface;
use App\Payment\Result\ErrorConfirmPaymentResult;
use App\Payment\Result\NewPaymentResultInterface;
use App\Payment\Result\SuccessConfirmPaymentResult;
use App\Payment\Result\SuccessNewPaymentResult;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PaymentService implements PaymentServiceInterface
{
    private $router;
    private $serializer;
    private $requestFactory;
    private $httpClient;
    private $cardStorage;
    private $cardFilterFactory;
    private $errorFactory;
    private $eventDispatcher;

    public function __construct(
        RouterInterface $router,
        PaymentRequestSerializerInterface $serializer,
        PaymentRequestFactoryInterface $requestFactory,
        HttpClientInterface $httpClient,
        CardStorageInterface $cardStorage,
        CardFilterFactoryInterface $cardFilterFactory,
        ErrorFactoryInterface $errorFactory,
        PaymentEventDispatcherInterface $eventDispatcher
    ) {
        $this->router = $router;
        $this->serializer = $serializer;
        $this->requestFactory = $requestFactory;
        $this->httpClient = $httpClient;
        $this->cardStorage = $cardStorage;
        $this->cardFilterFactory = $cardFilterFactory;
        $this->errorFactory = $errorFactory;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function new(NewPaymentRequestInterface $request): NewPaymentResultInterface
    {
        return new SuccessNewPaymentResult(
            $this->router->generate(
                'payment_confirm',
                ['hash' => $this->serializer->serializeNewPaymentRequest($request)],
                RouterInterface::ABSOLUTE_URL
            )
        );
    }

    public function confirm(
        NewPaymentRequestInterface $newPaymentRequest,
        ConfirmPaymentRequestInterface $confirmPaymentRequest
    ): ConfirmPaymentResultInterface {
        $cards = $this->cardFilterFactory->create($confirmPaymentRequest->getNumber())
            ->filter($this->cardStorage->getAll());

        /** @var CardInterface $card */
        if (null === $card = $cards->current()) {
            return new ErrorConfirmPaymentResult($this->errorFactory->createError(ErrorCodeDictionary::CARD_NOT_FOUND));
        }

        $status = CallbackPaymentRequestInterface::STATUS_FAILED;
        if (true === $card->isPayable()) {
            $status = CallbackPaymentRequestInterface::STATUS_SUCCESS;
        }

        $this->eventDispatcher->dispatchCallbackEvent(
            $this->requestFactory->createCallbackPaymentRequest(
                $status,
                $newPaymentRequest
            )
        );

        return new SuccessConfirmPaymentResult();
    }
}
