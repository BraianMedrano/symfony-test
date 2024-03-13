<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Pais', TextType::class, [
                'label' => 'Pais',
                'attr' => [
                    'placeholder' => 'Ingrese el nombre del pais'
                ]
            ])
            ->add('Continente', ChoiceType::class, [
                'label' => 'Continente',
                'choices' => [
                    'America' => 'America',
                    'Europa' => 'Europa',
                    'Asia' => 'Asia',
                    'Africa' => 'Africa',
                    'Oceania' => 'Oceania',
                    'Antartida' => 'Antartida'
                ]
            ])
            ->add('Descripcion', TextareaType::class, [
                'label' => 'Descripcion',
                'attr' => [
                    'placeholder' => 'Ingrese una descripcion del pais'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
