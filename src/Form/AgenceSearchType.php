<?php

namespace App\Form;

use App\Entity\Agence;
use App\Dto\AgenceSearchDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AgenceSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('Telephone', EntityType::class, [
            'class' => Agence::class,
            'choice_label' => 'Telephone',
            'attr' => [
                'class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 mb-2 '
            ]
        ])
        ->add('Adresse', EntityType::class, [
            'class' => Agence::class,
            'choice_label' => 'Adresse',
            'attr' => [
                'class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5'
            ]
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Search',
            'attr' => [
                'class' => 'text-white bg-blue-700 px-10 py-2 rounded-lg w-full mt-2 mb-2'
            ]
        ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AgenceSearchDto::class,

        ]);
    }
}
