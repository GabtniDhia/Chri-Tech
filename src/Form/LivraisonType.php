<?php

namespace App\Form;

use App\Entity\Livraison;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivraisonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('adresse', TextType::class, [
                'attr' => [
                    'placeholder'=> 'Entrer votre Adresse'
                ]
            ])
            ->add('codepostal', TextType::class, [
                'attr' => [
                    'placeholder'=> 'Entrer votre Code Postal'
                ]
            ])
            ->add('ville', TextType::class, [
                'attr' => [
                    'placeholder'=> 'Entrer votre ville'
                ]
            ])
            ->add('datelivraison')

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livraison::class,
        ]);
    }
}
