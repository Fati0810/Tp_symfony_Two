<?php

namespace App\Controller\Admin;

use App\Entity\Vehicule;
use App\Form\VehiculeFormType;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminVehiculeController extends AbstractController
{

    /**
     * @Route("/admin/vehicules", name="admin_vehicule_list")
     */
    public function adminVehiculeList(VehiculeRepository $vehiculeRepository)
    {
        $vehicules = $vehiculeRepository->findAll();

        return $this->render("admin/vehicule_list.html.twig", ['vehicules' => $vehicules]);
    }

    /**
     * @Route("admin/vehicule/{id}", name="admin_vehicule_show")
     */
    public function adminVehiculeShow($id, VehiculeRepository $vehiculeRepository)
    {
        $vehicule = $vehiculeRepository->find($id);

        return $this->render("admin/vehicule_show.html.twig", ['vehicule' => $vehicule]);
    }

    /**
     * @Route("admin/create/vehicule", name="admin_vehicule_create")
     */
    public function adminCreateVehicule(EntityManagerInterface $entityManagerInterface, Request $request)
    {
        $vehicule = New Vehicule();

        $vehiculeForm = $this->createForm(VehiculeFormType::class, $vehicule);

        $vehiculeForm->handleRequest($request);

        if($vehiculeForm->isSubmitted() && $vehiculeForm->isValid()){
            $entityManagerInterface->persist($vehicule);
            $entityManagerInterface->flush();

            return $this->redirectToRoute("admin_vehicule_list");
        }

        return $this->render("admin/vehicule_form.html.twig", ['vehiculeForm' => $vehiculeForm->createView()]);
    }

    
    /**
     * @Route("/{id}/update", name="admin_vehicule_update")
     */
    public function adminVehiculeUpdate($id, VehiculeRepository $vehiculeRepository, EntityManagerInterface $entityManagerInterface, Request $request)
    {
        $vehicule = $vehiculeRepository->find($id);

        $vehiculeForm = $this->createForm(VehiculeFormType::class, $vehicule);

        $vehiculeForm->handleRequest($request);

        if($vehiculeForm->isSubmited() && $vehiculeForm->isValid()){
            $entityManagerInterface->persist($vehicule);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('admin_vehicule_list');
        }

        return $this->render("admin/vehicule_form.html.twig", ['vehiculeForm' => $vehiculeForm->createView()]);

    }

    /**
     * @Route("/delete/vehicule/{id}", name="admin_vehicule_delete")
     */
    public function adminDeleteVehicule($id, EntityManagerInterface $entityManagerInterface, 
    VehiculeRepository $vehiculeRepository)
    {
        $vehicule = $vehiculeRepository->find($id);

        $entityManagerInterface->remove($vehicule);
        $entityManagerInterface->flush();

        return $this->redirectToRoute('admin_vehicule_list');
    }
}

