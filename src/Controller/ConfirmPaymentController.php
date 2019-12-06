<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\Type\ConfirmPaymentRequestType;
use App\Payment\Request\Serializer\PaymentRequestSerializerInterface;
use App\Payment\Service\PaymentServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class ConfirmPaymentController extends AbstractController
{
    private $formFactory;
    private $serializer;
    private $service;
    private $translator;

    public function __construct(
        FormFactoryInterface $formFactory,
        PaymentRequestSerializerInterface $serializer,
        PaymentServiceInterface $service,
        TranslatorInterface $translator
    ) {
        $this->formFactory = $formFactory;
        $this->serializer = $serializer;
        $this->service = $service;
        $this->translator = $translator;
    }

    /**
     * @inheritDoc
     * @Route("/confirm", name="payment_confirm", methods={"GET", "POST"})
     */
    public function __invoke(Request $request): Response
    {
        $hash = $request->get('hash', '');
        $serializerResult = $this->serializer->unserializeNewPaymentRequest($hash);
        if (null !== $error = $serializerResult->getError()) {
            throw $this->createNotFoundException();
        }

        $form = $this->formFactory->create(ConfirmPaymentRequestType::class);
        $form->handleRequest($request);
        if (true === $form->isSubmitted() && true === $form->isValid()) {
            $confirmResult = $this->service->confirm($serializerResult->getRequest(), $form->getData());
            if (null === $error = $confirmResult->getError()) {
                return $this->redirectToRoute('confirm_success', ['hash' => $hash]);
            }

            $this->addFlash('error', $this->translator->trans($error->getCode(), [], 'error_codes'));
        }

        return $this->render(
            'payment/confirm.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
