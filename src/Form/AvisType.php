<?php

namespace App\Form;

use App\Entity\Avis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Etat_Service',ChoiceType::class, array(
                'choices'=> array(
                    'Excellent'=> 'Excellent',
                    'Bien' => 'Bien',
                    'Moyen' => 'Moyen',
                    'Mauvais' => 'Mauvais',
                    'Catastrophique' => 'Catastrophique',
                ),
            ))
            ->add('Recommendation',ChoiceType::class, [
                'choices'  => [
                    'Oui' => 'oui',
                    'Non' => 'non',
                ],
                'expanded' => 'oui',
            ] )
            ->add('DescriptionService')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Avis::class,
        ]);
    }
}