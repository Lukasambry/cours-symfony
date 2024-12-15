<?php

declare(strict_types=1);

namespace App\Controller\Other;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ListController extends AbstractController
{
    #[Route(path: '/lists', name: 'list')]
    #[IsGranted('ROLE_USER')]
    public function show(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('homepage');
        }
        return $this->render('other/lists.html.twig');
    }
}
