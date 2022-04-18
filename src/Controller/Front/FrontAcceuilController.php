<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontAcceuilController extends AbstractController
{
    #[Route('/', name: 'app_front_acceuil')]
    public function index(): Response
    {
        return $this->render('front/acceuil.html.twig', [
            'controller_name' => 'FrontAcceuilController',
        ]);
    }
}
