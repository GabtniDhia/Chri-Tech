<?php

namespace App\Form;

use App\Entity\Rendezvous;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class RendezvousType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('service', ChoiceType::class, array(
                'choices'=> array(
                    'Reparation'=> 'Reparation',
                    'Installation' => 'Installation',
                ),
            ))
            ->add('date_rendezvous',DateTimeType::class, [
                'placeholder' => [
                    'année' => 'Année', 'mois' => 'Mois', 'jour' => 'Jour',
                    'heure' => 'Heure', 'minute' => 'Minute', 'seconde' => 'Seconde',
                ],
            ])
            ->add('description_rendezvous' )
            ->add('adressrend')

            ->add('telephonenum')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rendezvous::class,
        ]);
    }
}
