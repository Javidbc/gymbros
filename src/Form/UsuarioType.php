<?php

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
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
                'label'=>'Teléfono del usuario'
            ])
            ->add('fechaNacimiento',DateType::class,[
                'label'=>'Fecha de Nacimiento del usuario',
                'widget'=>'single_text'
            ])
            ->add('correo',EmailType::class,[
                'label'=>'Correo del usuario'
            ])
            ->add('contrasenia',PasswordType::class,[
                'label'=>'Contraseña temporal del usuario'
            ])
            ->add('brochure', FileType::class, [
                'label' => 'Sube tu foto aqui',
                'mapped' => false,
                'required' => false,
                'empty_data'  => "",
                /*'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Tiene que ser una imagen en formato jpeg o png',
                    ])
                ],*/
            ])
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
