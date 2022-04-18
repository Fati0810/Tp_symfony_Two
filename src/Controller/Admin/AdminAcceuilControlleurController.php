<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminAcceuilControlleurController extends AbstractController
{
    #[Route('/admin/', name: 'admin_acceuil_controlleur')]
    public function index(): Response
    {
        return $this->render('admin/acceuil.html.twig', [
            'controller_name' => 'AdminAcceuilControlleurController',
        ]);
    }
}
