<?php

namespace App\Controller\Front;

use App\Entity\Commande;
use App\Form\CommandeFormType;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class FrontCommandeController extends AbstractController
{
    /**
     * @Route("/commandes", name="commande_list")
     */
    public function commandeList(CommandeRepository $commandeRepository)
    {
        $commandes = $commandeRepository->findAll();

        return $this->render("front/commande_list.html.twig", ['commandes' => $commandes]);
    }


    /**
     * @Route("/commande/{id}", name="commande_show")
     */
    public function commandeShow($id, CommandeRepository $commandeRepository)
    {
        $commande = $commandeRepository->find($id);

        return $this->render("front/commande_show.html.twig", ['commande' => $commande]);
    }

    /**
     * @Route("/create/commande", name="commande_create")
     */
    public function createCommande( EntityManagerInterface $entityManagerInterface, Request $request)
    {
        $commande = New Commande();

        $commandeForm = $this->createForm(CommandeFormType::class, $commande);
        
        // $membre = $userRepository->find($id);
        // $membre = $userRepository->get('email')->getData();

        // $membre = $commandeForm["id_membre"]->getData(email);
        // $commandeForm["id_membre,email"]->getData();
        // $membre = $this->get('email')->getData(); 


        // if(function_exists('date_between'))
        //     public function dateBetween($date_start, $date_end)
        //     {
        //         if(!$date_start || !$date_end) return 0;
       
         
        //         if( class_exists('DateTime') )
        //         {   
        //             $date_start = new DateTime( $date_start );
        //             $date_end = new DateTime( $date_end );
        //             return $date_end->diff($date_start)->format('%a');
        //          }else{           
        //             return abs( round( ( strtotime($date_start) - strtotime($date_end) ) / 86400 ) );
        //         }
            
        //     } endif;

        //     $valeurdate = $commandeForm->get('date_between')->getData();
            
        //     $valeurPrixJournalier = $vehicule->get('prix_journalier');

        //     $valeurprix = ('prixJournalier') * ('date_beetween');


        
        $commandeForm->handleRequest($request);

        if($commandeForm->isSubmitted() && $commandeForm->isValid()){

            $entityManagerInterface->persist($commande);
            $entityManagerInterface->flush();

            return $this->redirectToRoute("commande_list");
        }

        return $this->render("front/commande_form.html.twig", ['commandeForm' => $commandeForm->createView()]);
    }


}
