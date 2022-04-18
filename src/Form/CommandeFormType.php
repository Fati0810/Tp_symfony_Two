<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Commande;
use App\Entity\Vehicule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CommandeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_heure_depart')
            ->add('date_heure_fin')
            ->add('prix_total')
            ->add('date_enregistrement')
            ->add('id_membre', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email'
            ])
            ->add('id_vehicule', EntityType::class, [
                'class' => Vehicule::class,
                'choice_label' => 'titre'
            ])
            ->add('Enregistrer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
