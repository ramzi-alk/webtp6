<?php
namespace App\Form;

use App\Entity\Commerce;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommerceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dresseur', null, [
                'disabled' => true,
            ])
            ->add('pokemon', null, [
                'disabled' => true,
            ])
            ->add('salePrice')
            ->add('acheteur', null, [
                'disabled' => true,
            ]);
    }
    public function buildFormBuy(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dresseur', null, [
                'hidden' => true,
            ])
            ->add('pokemon', null, [
                'disabled' => true,
            ])
            ->add('salePrice')
            ->add('acheteur', null, [
                'hidden' => true,
            ]);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commerce::class,
        ]);
    }
}
