<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Payment\Request\ConfirmPaymentRequest;
use App\Payment\Request\ConfirmPaymentRequestInterface;
use App\Payment\Request\Factory\PaymentRequestFactoryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class ConfirmPaymentRequestType extends AbstractType implements DataMapperInterface
{
    public const FIELD_NUMBER = ConfirmPaymentRequestInterface::FIELD_NUMBER;
    public const FIELD_HOLDER = ConfirmPaymentRequestInterface::FIELD_HOLDER;
    public const FIELD_CVV = ConfirmPaymentRequestInterface::FIELD_CVV;
    public const FIELD_EXPIRATION_MONTH = ConfirmPaymentRequestInterface::FIELD_EXPIRATION_MONTH;
    public const FIELD_EXPIRATION_YEAR = ConfirmPaymentRequestInterface::FIELD_EXPIRATION_YEAR;

    private $paymentRequestFactory;

    public function __construct(PaymentRequestFactoryInterface $paymentRequestFactory)
    {
        $this->paymentRequestFactory = $paymentRequestFactory;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                self::FIELD_NUMBER,
                TextType::class,
                [
                    'required'    => true,
                    'constraints' => [
                        new NotBlank(),
                        new Type('numeric'),
                        new Length(
                            [
                                'min' => 16,
                                'max' => 16,
                            ]
                        ),
                    ],
                ]
            )
            ->add(
                self::FIELD_HOLDER,
                TextType::class,
                [
                    'required'    => true,
                    'constraints' => [
                        new NotBlank(),
                    ],
                ]
            )
            ->add(
                self::FIELD_CVV,
                TextType::class,
                [
                    'required'    => true,
                    'constraints' => [
                        new NotBlank(),
                        new Type('numeric'),
                        new Length(
                            [
                                'min' => 3,
                                'max' => 3,
                            ]
                        ),
                    ],
                ]
            )
            ->add(
                self::FIELD_EXPIRATION_MONTH,
                IntegerType::class,
                [
                    'required'    => true,
                    'constraints' => [
                        new NotBlank(),
                        new Length(
                            [
                                'min' => 1,
                                'max' => 2,
                            ]
                        ),
                    ],
                ]
            )
            ->add(
                self::FIELD_EXPIRATION_YEAR,
                IntegerType::class,
                [
                    'required'    => true,
                    'constraints' => [
                        new NotBlank(),
                        new Length(
                            [
                                'min' => 4,
                                'max' => 4,
                            ]
                        ),
                    ],
                ]
            )
            ->setDataMapper($this);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class'         => ConfirmPaymentRequest::class,
                'csrf_protection'    => false,
                'allow_extra_fields' => true,
                'empty_data'         => null,
                'translation_domain' => 'forms',
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

        $viewData = $this->paymentRequestFactory->createConfirmPaymentRequest(
            (string)$forms[self::FIELD_NUMBER]->getData(),
            (string)$forms[self::FIELD_HOLDER]->getData(),
            (int)$forms[self::FIELD_CVV]->getData(),
            (int)$forms[self::FIELD_EXPIRATION_MONTH]->getData(),
            (int)$forms[self::FIELD_EXPIRATION_YEAR]->getData()
        );
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
