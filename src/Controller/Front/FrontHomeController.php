<?php

namespace App\Controller\Front;

use App\Repository\VehiculeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontHomeController extends AbstractController
{
    /**
     * @Route("search/", name="front_search")
     */
    public function search(VehiculeRepository $vehiculeRepository, Request $request)
    {
        $term = $request->query->get('term');
        $vehicules = $vehiculeRepository->searchByterm($term);

        return $this->render("front/search.html.twig", ['vehicules' => $vehicules, 'term' => $term]);
    }
}
