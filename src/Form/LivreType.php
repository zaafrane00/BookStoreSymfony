<?php

namespace App\Form;

use App\Entity\Livre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('auteur')
            ->add('statut', ChoiceType::class, [
                'choices'  => [
                    'Disponible' => 'Disponible',
                    'Non Disponible' => 'Non Disponible',
                ],
            ])
            ->add('date_emprunt')
            ->add('date_retour')
            ->add('categorie')
            // ->add('user', UserType::class)
            ->add('image', FileType::class, array('label' => 'Photo (png, jpeg)'));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
