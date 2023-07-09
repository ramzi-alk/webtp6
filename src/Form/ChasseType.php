<?php
namespace App\Form;

use App\Entity\Chasse;
use App\Repository\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;

class ChasseType extends AbstractType
{
    private $entityRepository;

    public function __construct(EntityRepository $entityRepository)
    {
        $this->entityRepository = $entityRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        
        $pokemonTypes = $this->entityRepository->findAll();
        
        $builder
            ->add('pokemon', null, [
                'label' => 'Pokémon : ',
            ])
            ->add('chasseworld', null, [
                'label' => 'Lieu de chasse : ',
            ]);
           
    }
    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chasse::class,
            'pokemon_id' => null, // Ajoutez cette option pour stocker l'ID du Pokémon
        ]);
    }
}
