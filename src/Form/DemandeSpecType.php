<?php

namespace App\Form;

use App\Entity\DemandeSpec;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeSpecType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('domaine', ChoiceType::class, [
                    'label' => 'Veuillez Choisir Votre Domaine',

                'choices' => [
                    'Installation' => 'Installation',
                    'Reparation' => 'Reparation',
                    'Service Technique' => 'Technique'
                ]
            ])
            ->add('cerif', FileType::class, [
                'label' => 'Veuillez Nous Fournir Une Certification'
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'rows' => '10',
                    'cols' => '30',
                    'placeholder' => 'Veuillez nous fournir une brieve description, vous pouvez siter vos experiance,demandes,qualites,defauts etc..'
                ]
            ])
            ->add('demandeur', EntityType::class,[
                'class' => User::class,
                'choice_label' => 'nom',
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DemandeSpec::class,
        ]);
    }
}
