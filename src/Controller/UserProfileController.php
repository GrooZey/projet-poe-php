<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user', name: 'app_user_')]
class UserProfileController extends AbstractController
{
    #[Route('/profile', name: 'profile')]
    public function profile(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserProfileController',
        ]);
    }
    #[Route('/profile', name: 'favorites')]
    public function favorites(): Response
    {
        return $this->render('user/favorites.html.twig', [
            'controller_name' => 'UserProfileController',
        ]);
    }
}
