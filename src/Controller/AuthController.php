<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthController extends AbstractController
{
    #[Route('/auth/login', name: 'auth.login')]
    public function login(): Response
    {
        return $this->render('auth/login.html.twig');
    }


    #[Route('/auth/forgot-password', name: 'auth.forgot-password')]
    public function forgot(): Response
    {
        return $this->render('auth/forgot.html.twig');
    }

    #[Route('/auth/register', name: 'auth.register')]
    public function register(): Response
    {
        return $this->render('auth/register.html.twig');
    }

    #[Route('/auth/confirm-account', name: 'auth.confirm-account')]
    public function reset(): Response
    {
        return $this->render('auth/confirm.html.twig');
    }

    #[Route('/auth/reset-password', name: 'auth.reset-password')]
    public function logout(): Response
    {
        return $this->render('auth/reset.html.twig');
    }
}
