<?php

declare(strict_types=1);

namespace App\Controller;

use App\Payment\Request\Serializer\PaymentRequestSerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SuccessConfirmPaymentController extends AbstractController
{
    private $serializer;

    public function __construct(PaymentRequestSerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @inheritDoc
     * @Route("/confirm/success", name="confirm_success", methods={"GET"})
     */
    public function __invoke(Request $request): Response
    {
        $serializerResult = $this->serializer->unserializeNewPaymentRequest($request->get('hash', ''));
        if (null !== $error = $serializerResult->getError()) {
            throw $this->createNotFoundException();
        }

        return $this->render(
            'payment/confirm_success.html.twig',
            [
                'request' => $serializerResult->getRequest(),
            ]
        );
    }
}
