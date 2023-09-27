<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Picture;

#[Route('/user', name: 'app_user_')]
class UserProfileController extends AbstractController
{
    #[Route('/profile', name: 'profile')]
    public function profile(): Response
    {
        return $this->render('user/index.html.twig');
    }

    #[Route('/pictures', name: 'pictures')]
    public function pictures(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Picture::class);
        $pictures = $repository->findBy(['publisher' => $this->getUser()],['date' => 'desc']);
        return $this->render('user/pictures.html.twig',[
            'pictures' => $pictures,
        ]);
    }

    #[Route('/favorites', name: 'favorites')]
    public function favorites(): Response
    {
        return $this->render('user/favorites.html.twig');
    }
}
