<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController
{
    /**
     * @inheritDoc
     * @Route("/", name="home")
     */
    public function __invoke(): Response
    {
        return new Response('ok');
    }
}
