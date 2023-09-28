<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Picture;

#[Route('/picture', name: 'app_picture_')]
class ShowPictureController extends AbstractController
{
    #[Route('/show/{id}', name: 'show')]
    public function show(EntityManagerInterface $entityManager, int $id): Response
    {
        $pic = $entityManager->getRepository(Picture::class)->find($id);
        if (!$pic) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        return $this->render('show/index.html.twig', [
            'picture' => $pic,
        ]);
    }
}
