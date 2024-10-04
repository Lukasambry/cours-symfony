<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin.index')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    #[Route('/admin/add-movie', name: 'admin.add-movie')]
    public function addMovie(): Response
    {
        return $this->render('admin/add-movie.html.twig');
    }

    #[Route('/admin/films', name: 'admin.films')]
    public function films(): Response
    {
        return $this->render('admin/films.html.twig');
    }

    #[Route('/admin/users', name: 'admin.users')]
    public function users(): Response
    {
        return $this->render('admin/users.html.twig');
    }
}
