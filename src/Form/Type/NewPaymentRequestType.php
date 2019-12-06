<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Payment\Request\Factory\PaymentRequestFactoryInterface;
use App\Payment\Request\NewPaymentRequest;
use App\Payment\Request\NewPaymentRequestInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class NewPaymentRequestType extends AbstractType implements DataMapperInterface
{
    public const FIELD_AMOUNT = NewPaymentRequestInterface::FIELD_AMOUNT;
    public const FIELD_CURRENCY_CODE = NewPaymentRequestInterface::FIELD_CURRENCY_CODE;
    public const FIELD_CALLBACK_URL = NewPaymentRequestInterface::FIELD_CALLBACK_URL;
    public const FIELD_REDIRECT_URL = NewPaymentRequestInterface::FIELD_REDIRECT_URL;

    public const CURRENCY_CODES = ['EUR', 'USD', 'UAH'];

    private $paymentRequestFactory;

    public function __construct(PaymentRequestFactoryInterface $paymentRequestFactory)
    {
        $this->paymentRequestFactory = $paymentRequestFactory;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                self::FIELD_AMOUNT,
                TextType::class,
                [
                    'required'    => true,
                    'constraints' => [
                        new NotBlank(),
                        new Type('numeric'),
                    ],
                ]
            )
            ->add(
                self::FIELD_CURRENCY_CODE,
                ChoiceType::class,
                [
                    'required'    => true,
                    'choices'     => self::CURRENCY_CODES,
                    'constraints' => [
                        new NotBlank(),
                    ],
                ]
            )
            ->add(
                self::FIELD_CALLBACK_URL,
                TextType::class,
                [
                    'required'    => true,
                    'constraints' => [
                        new NotBlank(),
                    ],
                ]
            )
            ->add(
                self::FIELD_REDIRECT_URL,
                TextType::class,
                [
                    'required'    => true,
                    'constraints' => [
                        new NotBlank(),
                    ],
                ]
            )
            ->setDataMapper($this);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class'         => NewPaymentRequest::class,
                'csrf_protection'    => false,
                'allow_extra_fields' => true,
                'empty_data'         => null,
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public function mapDataToForms($viewData, $forms)
    {
    }

    /**
     * @inheritDoc
     */
    public function mapFormsToData($forms, &$viewData)
    {
        /** @var FormInterface[]|\Generator $forms */
        $forms = iterator_to_array($forms);

        $viewData = $this->paymentRequestFactory->createNewPaymentRequest(
            (float)$forms[self::FIELD_AMOUNT]->getData(),
            (string)$forms[self::FIELD_CURRENCY_CODE]->getData(),
            (string)$forms[self::FIELD_CALLBACK_URL]->getData(),
            (string)$forms[self::FIELD_REDIRECT_URL]->getData()
        );
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
