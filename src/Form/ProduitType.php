<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Categorie;


class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Ref_Prod')
            ->add('Nom_Prod')
            ->add('Descri_Prod')
            ->add('PrixUnitHT_Prod')
            ->add('QteStock_Prod')
            ->add('image_Prod' , FileType::class, array('data_class' => null))
            ->add('Detail_Prod')
            ->add('PrixTTC_Prod')
            ->add('PrixTVA_Prod')
            ->add('cat',EntityType::class,[
                'class'=>Categorie::class,
                'choice_label'=>'Nom_Cat',

            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
