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
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dni',TextType::class,[
                'label'=>'DNI del usuario',
                'constraints' => [
                    new NotBlank(),
                    new Regex([
                        'pattern' => '/(0?[1-9]|[1-9][0-9])[0-9]{6}(-| )?[trwagmyfpdxbnjzsqvhlcke|TRWAGMYFPDXBNJZSQVHLCKE]/',
                        'message'=> 'Introduce un DNI válido'
                    ])
                ]
            ])
            ->add('nombre',TextType::class,[
                'label'=>'Nombre del usuario',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 3,
                        'max'=>50,
                        'minMessage'=>'Debe de tener un mínimo de 3 caracteres',
                        'maxMessage'=>'Debe de tener un máximo de 50 caracteres'
                    ]),
                ]
            ])
            ->add('apellidos',TextType::class,[
                'label'=>'Apellidos del usuario',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 3,
                        'max'=>100,
                        'minMessage'=>'Debe de tener un mínimo de 3 caracteres',
                        'maxMessage'=>'Debe de tener un máximo de 100 caracteres'
                    ]),
                ]
            ])
            ->add('telefono',TextType::class,[
                'label'=>'Teléfono del usuario',
                'constraints' => [
                    new NotBlank(),
                    new Regex([
                        'pattern' => '/(\+34|34)?[ -]*(6|7)[ -]*([0-9][ -]*){8}/',
                        'message'=> 'el telefono debe contener 9 numeros, empezar por 6 o 7 y  opcionalmente un +34'
                    ])
                ]
            ])
            ->add('fechaNacimiento',DateType::class,[
                'label'=>'Fecha de Nacimiento del usuario',
                'widget'=>'single_text',

            ])
            ->add('correo',EmailType::class,[
                'label'=>'Correo del usuario',
                'constraints' => [
                    new NotBlank(),
                    new Regex([
                        'pattern' => '/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/',
                        'message'=> 'Introduce un correo electrónico valido'
                    ])
                ]
            ])
            /*->add('contrasenia',PasswordType::class,[
                'label'=>'Contraseña temporal del usuario',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 3,
                        'max'=>20,
                        'minMessage'=>'Debe de tener un mínimo de 3 caracteres',
                        'maxMessage'=>'Debe de tener un máximo de 20 caracteres'
                    ]),
                ]
            ])*/
            ->add('brochure', FileType::class, [
                'label' => 'Sube tu foto aqui',
                'mapped' => false,
                'required' => false,
                'empty_data'  => "",
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Tiene que ser una imagen en formato jpeg o png',
                    ])
                ],
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
