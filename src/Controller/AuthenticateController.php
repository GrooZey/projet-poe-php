<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


#[Route('/authenticate', name: '')]
class AuthenticateController extends AbstractController
{
    #[Route('/signin', name: 'signin')]
    public function signup(UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $plaintextPassword = 'Mot2Passe';

        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);

        return $this->render('authenticate/signin.html.twig');
    }

    #[Route('/login', name: 'login')]
    public function signin(): Response
    {
        return $this->render('authenticate/login.html.twig');
    }

    #[Route('/logout', name: 'logout')]
    public function logout(): Response
    {
        return $this->render('authenticate/logout.html.twig');
    }

    #[Route('/signout', name: 'signout')]
    public function signout(): Response
    {
        return $this->render('authenticate/signout.html.twig');
    }
}
