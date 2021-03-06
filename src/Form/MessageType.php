<?php

namespace App\Form;

use App\Entity\Messages;
use App\Entity\User;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('message', TextType::class, [
                'attr' => [
                    'class' => 'write_msg',
                    'placeholder' => 'Ecrir Votre Message',
                    'autocomplete' => 'off'
                ]
            ])
            ->add('Envoyer', SubmitType::class, [

            ])
            ->add('recipient' , EntityType::class,[
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
            'data_class' => Messages::class,
        ]);
    }
}
