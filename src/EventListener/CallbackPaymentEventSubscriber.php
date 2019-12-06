<?php

declare(strict_types=1);

namespace App\EventListener;

use App\Payment\Event\CallbackPaymentEvent;
use App\Payment\Event\CallbackPaymentEventInterface;
use App\Payment\Request\CallbackPaymentRequestInterface;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\Console\Event\ConsoleTerminateEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\TerminateEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallbackPaymentEventSubscriber implements EventSubscriberInterface
{
    private $httpClient;

    /**
     * @var CallbackPaymentEventInterface[]
     */
    private $events = [];

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            CallbackPaymentEvent::class => ['collectEvent'],
            KernelEvents::TERMINATE  => ['onTerminate'],
            ConsoleEvents::TERMINATE => ['onConsoleTerminate']
        ];
    }

    public function onTerminate(TerminateEvent $event)
    {
        $this->sendRequests();
    }

    public function onConsoleTerminate(ConsoleTerminateEvent $event)
    {
        $this->sendRequests();
    }

    public function collectEvent(CallbackPaymentEventInterface $event)
    {
        $this->events[] = $event;
    }

    private function sendRequests()
    {
        foreach ($this->events as $event) {
            $this->sendRequest($event->getRequest());
        }

        $this->events = [];
    }

    private function sendRequest(CallbackPaymentRequestInterface $request)
    {
        try {
            $this->httpClient->request(
                'POST',
                $request->getRequest()->getCallbackUrl(),
                [
                    'headers' => [
                        'Content-type' => 'application/json'
                    ],
                    'body' => json_encode($request),
                ]
            );
        } catch (TransportExceptionInterface $exception) {
        }
    }
}
