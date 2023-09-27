<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/picture', name: 'app_picture')]
class PictureController extends AbstractController
{
    #[Route('/', name: '')]
    public function index(): Response
    {
        return $this->render('picture/index.html.twig');
    }
}
