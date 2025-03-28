<?php

namespace App\Form;

use App\Entity\Fournisseur;
use App\Entity\Order;
use App\Entity\Products;
use App\Entity\Rayon;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('price_ttc')
            ->add('description')
            ->add('id_fournisseur', EntityType::class, [
                'class' => Fournisseur::class,
                'choice_label' => 'name',
            ])
            ->add('id_rayon', EntityType::class, [
                'class' => Rayon::class,
                'choice_label' => 'nom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}
