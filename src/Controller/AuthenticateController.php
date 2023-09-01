<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthenticateController extends AbstractController
{
    #[Route('/authenticate', name: 'app_authenticate')]
    public function index(): Response
    {
        return $this->render('authenticate/index.html.twig', [
            'controller_name' => 'AuthenticateController',
        ]);
    }
}
