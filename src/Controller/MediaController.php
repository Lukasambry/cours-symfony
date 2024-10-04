<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MediaController extends AbstractController
{
    #[Route('/media/category', name: 'media.category')]
    public function index(): Response
    {
        return $this->render('media/category.html.twig');
    }

    #[Route('/media/detail', name: 'media.detail')]
    public function playlist(): Response
    {
        return $this->render('media/detail.html.twig');
    }

    #[Route('/media/detail-serie', name: 'media.detail-serie')]
    public function detailSerie(): Response
    {
        return $this->render('media/detail-serie.html.twig');
    }

    #[Route('/media/discover', name: 'media.discover')]
    public function discover(): Response
    {
        return $this->render('media/discover.html.twig');
    }

    #[Route('/media/list', name: 'media.list')]
    public function list(): Response
    {
        return $this->render('media/list.html.twig');
    }

    #[Route('/media/upload', name: 'media.upload')]
    public function upload(): Response
    {
        return $this->render('media/upload.html.twig');
    }
}
