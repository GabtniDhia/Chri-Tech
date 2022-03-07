<?php

namespace App\Form;

use App\Entity\Blog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('utilisateur', TextType::class,[
                'attr' => [
                    'placeholder'=> 'Entrer votre Nom'
                ]
            ])

            ->add('titre', TextType::class,[
                    'attr' => [
                        'placeholder'=> 'entrez le titre'
                    ]
                ])

            ->add('contenue', TextType::class,[
                    'attr' => [
                        'placeholder'=> 'exprimez-vous'
                    ]
                ])
            ->add('img', FileType::class, array('data_class' => null));

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Blog::class,
        ]);
    }
}
