<?php

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class CambioContraType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('contraNueva', RepeatedType::class, [
                'required' => true,
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'Las contraseñas no coinciden',
                'first_options' => [
                    'label' => 'Introduce tu nueva contraseña:',
                    'constraints' => [
                        new NotBlank([
                            'groups' => ['password']
                        ])
                    ]
                ],
                'second_options' => [
                    'label' => 'Repite tu nueva contraseña',
                    'required' => true
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
