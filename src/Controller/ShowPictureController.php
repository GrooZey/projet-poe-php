<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Picture;

#[Route('/picture', name: 'app_picture_')]
class ShowPictureController extends AbstractController
{
    #[Route('/show', name: 'show')]
    public function show(Picture $pic): Response
    {
        return $this->render('show/index.html.twig', [
        ]);
    }
}
