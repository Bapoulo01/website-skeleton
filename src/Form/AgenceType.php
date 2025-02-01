<?php

namespace App\Form;

use App\Entity\Agence;
use App\Dto\AgenceTypeDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AgenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Numero',TextType::class,[
                'attr' => [
                    'class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 mt-1',
                    'placeholder' => 'Entrez le numéro'
                ]
            ])
            ->add('Adresse', TextType::class, [
                'attr' => [
                    'class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 mt-1',
                    'placeholder' => "Entrez l'Adresse"
                ]
            ])
            ->add('Telephone',TextType::class, [
                'attr' => [
                    'class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 mt-1',
                    'placeholder' => 'Entrez le numéro de telephone'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AgenceTypeDto::class,
        ]);
    }
}
