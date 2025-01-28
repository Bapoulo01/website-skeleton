<?php

namespace App\Form;

use App\Form\AgenceType;
use App\Entity\AgenceSearchDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;


class AgenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('Numero', TextType::class, options:[
            'attr' => [
                'class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5',
                'placeholder' => "Libellé de la classe"
            ]
        ])
        ->add('Adresse', [
            'choice_label' => 'Adresse',
            'attr' => [
                'class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 mt-1'
            ]
        ])
        ->add('Telephone', [
            'choice_label' => 'Telephone',
            'attr' => [
                'class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5'
            ]
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Submit',
            'attr' => [
                'class' => 'text-white bg-blue-700 px-10 py-2 rounded-lg w-full mt-5'
            ]
]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AgenceType::class,
        ]);
    }
}
