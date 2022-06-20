<?php

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PerfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('telefono',TextType::class,[
                'label'=>'Teléfono',
                'constraints' => [
                    new NotBlank(),
                    new Regex([
                        'pattern' => '/(\+34|34)?[ -]*(6|7)[ -]*([0-9][ -]*){8}/',
                        'message'=> 'el telefono debe contener 9 numeros, empezar por 6 o 7 y  opcionalmente un +34'
                    ])
                ]
            ])
            ->add('contrasenia',PasswordType::class,[
                'label'=>'Contraseña',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 3,
                        'max'=>20,
                        'minMessage'=>'Debe de tener un mínimo de 3 caracteres',
                        'maxMessage'=>'Debe de tener un máximo de 20 caracteres'
                    ]),
                ]
            ])
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }
}
