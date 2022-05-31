<?php

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dni')
            ->add('nombre')
            ->add('apellidos')
            ->add('telefono')
            ->add('fechaNacimiento')
            ->add('correo')
            ->add('contrasenia')
            ->add('foto')
            ->add('activado')
            ->add('esAdmin')
            ->add('esMonitor')
            ->add('miTabla')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }
}
