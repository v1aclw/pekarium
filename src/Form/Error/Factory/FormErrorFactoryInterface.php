<?php

declare(strict_types=1);

namespace App\Form\Error\Factory;

use App\Error\ErrorInterface;
use Symfony\Component\Form\FormInterface;

interface FormErrorFactoryInterface
{
    public function createFromForm(FormInterface $form): ErrorInterface;
}
