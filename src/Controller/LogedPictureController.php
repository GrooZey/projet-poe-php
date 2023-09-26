<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Form\AddPictureType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

#[Route('/user/picture', name: 'app_loged_picture_')]
class LogedPictureController extends AbstractController
{
    #[Route('/add', name: 'add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $pic = new Picture();
        $form = $this->createForm(AddPictureType::class, $pic);
        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid() ) {
            $entityManager->persist($pic);
            $entityManager->flush();
            $this->addFlash("success", "L'image a bien été enregistrée");
            return $this->redirectToRoute('app_user_profile');
        }

        return $this->render('picture/new.html.twig', [
            'addPicture' => $form->createView(),
        ]);
    }
}
