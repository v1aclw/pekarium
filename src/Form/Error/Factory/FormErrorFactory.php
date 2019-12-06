<?php

declare(strict_types=1);

namespace App\Form\Error\Factory;

use App\Dictionary\ErrorCodeDictionary;
use App\Error\ErrorInterface;
use App\Error\Factory\ErrorFactoryInterface;
use Symfony\Component\Form\FormInterface;

class FormErrorFactory implements FormErrorFactoryInterface
{
    private $errorFactory;

    public function __construct(ErrorFactoryInterface $errorFactory)
    {
        $this->errorFactory = $errorFactory;
    }

    public function createFromForm(FormInterface $form): ErrorInterface
    {
        if (false === $form->isSubmitted()) {
            return $this->errorFactory->createError(ErrorCodeDictionary::VALIDATION_ERROR);
        }

        return $this->errorFactory->createError(ErrorCodeDictionary::VALIDATION_ERROR, $this->getFormErrors($form));
    }

    private function getFormErrors(FormInterface $form): array
    {
        $errors = [];

        foreach ($form->getErrors() as $error) {
            $errors[$form->getName()][] = $error->getMessage();
        }

        /** @var FormInterface $child */
        foreach ($form as $child) {
            if (!$child->isValid()) {
                foreach ($child->getErrors() as $error) {
                    $errors[$child->getName()][] = $error->getMessage();
                }
            }
        }

        return $errors;
    }
}
