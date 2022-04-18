<?php

namespace App\Controller\Front;

use App\Repository\VehiculeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontVehiculeController extends AbstractController
{
    /**
     * @Route("/vehicules", name="vehicule_list")
     */
    public function vehiculeList(VehiculeRepository $vehiculeRepository)
    {
        $vehicules = $vehiculeRepository->findAll();

        return $this->render("front/vehicule_list.html.twig", ['vehicules' => $vehicules]);
    }

    /**
     * @Route("/vehicule/{id}", name="vehicule_show")
     */
    public function vehiculeShow($id, VehiculeRepository $vehiculeRepository)
    {
        $vehicule = $vehiculeRepository->find($id);

        return $this->render("front/vehicule_show.html.twig", ['vehicule' => $vehicule]);
    }
}
