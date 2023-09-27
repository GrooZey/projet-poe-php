<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Form\AddPictureType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/user/picture', name: 'app_loged_picture_')]
class LogedPictureController extends AbstractController
{
    #[Route('/add', name: 'add')]
    public function add(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $pic = new Picture();
        $form = $this->createForm(AddPictureType::class, $pic);
        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid() ) {
            
            $file = $form->get('file')->getData();
            if ($file) {

                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();

                $now = new \DateTime();
                $now->format('Y-m-d H:i:s');

                try {
                    $file->move($this->getParameter('upload'), $newFilename);

                    $pic->setPath($newFilename);
                    $pic->setDate($now);
                    $pic->setPublisher($this->getUser());

                } catch (FileException $e) {
                    throw new \Exception('Something went wrong!');
                }
            }
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
