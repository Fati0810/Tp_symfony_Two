<?php

namespace App\Controller\Admin;

use App\Entity\Commande;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\CommandeFormType;

class AdminCommandeController extends AbstractController
{

    /**
     * @Route("admin/commandes", name="admin_commande_list")
     */
    public function adminCommandeList(CommandeRepository $commandeRepository)
    {
        $commandes = $commandeRepository->findAll();

        return $this->render("admin/commande_list.html.twig", ['commandes' => $commandes]);
    }


    /**
     * @Route("admin/commande/{id}", name="admin_commande_show")
     */
    public function adminCommandeShow($id, CommandeRepository $commandeRepository)
    {
        $commande = $commandeRepository->find($id);

        return $this->render("admin/commande_show.html.twig", ['commande' => $commande]);
    }

    /**
     * @Route("admin/create/commande", name="admin_commande_create")
     */
    public function adminCreateCommande(EntityManagerInterface $entityManagerInterface, Request $request)
    {
        $commande = New Commande();

        $commandeForm = $this->createForm(CommandeFormType::class, $commande);

        $commandeForm->handleRequest($request);

        if($commandeForm->isSubmitted() && $commandeForm->isValid()){
            $entityManagerInterface->persist($commande);
            $entityManagerInterface->flush();

            return $this->redirectToRoute("admin_commande_list");
        }

        return $this->render("admin/commande_form.html.twig", ['commandeForm' => $commandeForm->createView()]);
    }

    /**
     * @Route("/{id}/update", name="admin_commande_update")
     */
    public function adminCommandeUpdate($id, CommandeRepository $commandeRepository, EntityManagerInterface $entityManagerInterface, Request $request)
    {
        $commande = $commandeRepository->find($id);

        $commandeForm = $this->createForm(CommandeFormType::class, $commande);

        $commandeForm->handleRequest($request);

        if($commandeForm->isSubmitted() && commandeForm->isValid()){
            $entityManagerInterface->persist($commande);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('admin_commande_list');
        }

        return $this->render("admin/commande_form.html.twig", ['$commandeForm', $commandeForm->createView()]);

    }

    /**
     * @Route("/delete/commande/{id}", name="admin_commande_delete")
     */
    public function adminDeleteCommande($id, EntityManagerInterface $entityManagerInterface, CommandeRepository $commandeRepository)
    {
        $commande = $commandeRepository->find($id);

        $entityManagerInterface->remove($commande);
        $entityManagerInterface->flush();

        return $this->redirectToRoute('admin_commande_list');
    }
}
