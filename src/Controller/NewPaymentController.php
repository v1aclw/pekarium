<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\Error\Factory\FormErrorFactoryInterface;
use App\Form\Type\NewPaymentRequestType;
use App\Payment\Service\PaymentServiceInterface;
use App\Result\ErrorResult;
use App\Result\ResultInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewPaymentController
{
    private $service;
    private $formFactory;
    private $formErrorFactory;

    public function __construct(
        PaymentServiceInterface $service,
        FormFactoryInterface $formFactory,
        FormErrorFactoryInterface $formErrorFactory
    ) {
        $this->service = $service;
        $this->formFactory = $formFactory;
        $this->formErrorFactory = $formErrorFactory;
    }

    /**
     * @inheritDoc
     * @Route("/new", name="payment_new", methods={"POST"})
     */
    public function __invoke(Request $request): Response
    {
        $form = $this->formFactory->create(NewPaymentRequestType::class);
        $form->submit($request->request->all());
        if (true === $form->isValid()) {
            $result = $this->service->new($form->getData());
            if (null !== $result->getError()) {
                return new JsonResponse($result, 400);
            }

            return new JsonResponse($result);
        }

        return new JsonResponse(new ErrorResult($this->formErrorFactory->createFromForm($form)));
    }
}
