<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class EditUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email' , EmailType::class , [
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez Saisir une adresse Mail'
                        ])
                     ],
                'required' => true,
                'attr' => [
                    'class' => 'form-control'
                ]
                ])

            ->add('roles', ChoiceType::class,[
                'choices' => [
                    'Client' => 'ROLE_CLIENT' ,
                    'Specialiste' => 'ROLE_SPECIALISTE' ,
                    'Administrateur' => 'ROLE_ADMIN'
                ],
                'expanded' => true,
                'multiple' => true,
                'label' => 'Roles'
            ])
            ->add('nom')
            ->add('prenom')
            ->add('isVerified')
            ->add('Valider' , SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
