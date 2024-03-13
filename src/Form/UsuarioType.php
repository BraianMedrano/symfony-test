<?php

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        // La estructura de los campos del formulario se pueden modificar, ya sea para agregarle un label, un placeholder, un atributo, etc.
        // Por ejemplo en el formulario de abajo (lo de nombre no se puede modificar por que asi es la tabla en la base de datos) pero si los atributos, placeholder, etc.

        // Tambien se puede cambiar el tipo de campo, por ejemplo si queremos que el campo de nombre sea un email, un password, etc. En el caso de abajo es un TextType
            ->add('nombre', TextType::class, [
                'label' => 'Nombre',
                'attr' => [
                    'placeholder' => 'Ingrese su nombre'
                ]
            ])
            ->add('apellido', TextType::class, [
                'label' => 'Apellido',
                'attr' => [
                    'placeholder' => 'Ingrese su apellido'
                ]
            ])
            ->add('edad', IntegerType::class, [
                'label' => 'Edad',
                'attr' => [
                    'placeholder' => 'Ingrese su edad'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }
}
