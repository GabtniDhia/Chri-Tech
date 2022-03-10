<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Entity\Offre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class Offre1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('description')
        ->add('image')
          ->add('type', ChoiceType::class, [
                'choices'  => [
                    'Standard' => '0' ,
                    'Silver' => '1',
                    'Gold' => '2', 
                    'Premium' => '3',
                ],
            ])
            ->add('prix')
            ->add('points')
            ->add('time', DateType::class, [
                'widget' => 'choice',
                'input'  => 'datetime'])
            ->add('date', DateTimeType::class, [
                'widget' => 'choice',
                'input'  => 'datetime'])
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Offre::class,
        ]);
    }
}
