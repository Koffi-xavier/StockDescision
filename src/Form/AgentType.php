<?php

namespace App\Form;

use App\Entity\Agent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('matricule')
            ->add('nom')
            ->add('prenoms')
            ->add('sexe')
            ->add('datedenaissance')
            ->add('grade')
            ->add('Emploi')
            ->add('civilite')
            ->add('premiereprisedeservice')
            ->add('email')
            ->add('telephone')
            ->add('telephone1')
            ->add('structure')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Agent::class,
        ]);
    }
}
