<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('entete', TextType::class,[
                    'attr' => [
                        'placeholder'=> 'entrez le titre'
                    ]
                ]
            )
            ->add('corp', TextType::class,[
        'attr' => [
            'placeholder'=> 'ecrivez votre article'
        ]
    ])
          
            ->add('redacteur', TextType::class,[
                    'attr' => [
                        'placeholder'=> 'entrez votre nom'
                    ]
                ])
            ->add('image', FileType::class, array('data_class' => null));
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
