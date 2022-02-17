<?php

namespace App\Form;

use App\Entity\Rendezvous;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RendezvousType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('Service', ChoiceType::class, array(
                'choices'=> array(
                    'Reparation'=> 'Reparation',
                    'Installation' => 'Installation',
                ),
            ))
            ->add('date_Rendezvous')
            ->add('Description_Rendezvous')
            ->add('telephonenum')
            ->add('adresserend')

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rendezvous::class,
        ]);
    }
}
