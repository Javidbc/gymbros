<?php

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dni',TextType::class,[
                'label'=>'DNI del usuario'
            ])
            ->add('nombre',TextType::class,[
                'label'=>'Nombre del usuario'
            ])
            ->add('apellidos',TextType::class,[
                'label'=>'Apellidos del usuario'
            ])
            ->add('telefono',TextType::class,[
                'label'=>'Telefono del usuario'
            ])
            ->add('fechaNacimiento',BirthdayType::class,[
                'label'=>'Fecha de Nacimiento del usuario'
            ])
            ->add('correo',EmailType::class,[
                'label'=>'Correo del usuario'
            ])
            ->add('contrasenia',PasswordType::class,[
                'label'=>'Contraseña temporal del usuario'
            ])
            ->add('imageFile', VichImageType::class)
            ->add('activado',CheckboxType::class,[
                'label'=>'Activar',
                'required'=>false,
                'empty_data'  => null
            ])
            ->add('esAdmin',CheckboxType::class,[
                'label'=>'¿Es administrador?',
                'required'=>false,
                'empty_data'  => null
            ])
            ->add('esMonitor',CheckboxType::class,[
                'label'=>'¿Es monitor?',
                'required'=>false,
                'empty_data'  => null
            ])
            /*->add('miTabla')*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }
}
