<?php

namespace App\Form;

use App\Entity\Horario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class HorarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('hora',TextType::class,[
                'label'=>'Hora para reservar la maquina',
                'constraints' => [
                    new NotBlank(),
                    new Regex([
                        'pattern' => '/([0-1][0-9]|2[0-3]):[0-5][0-9]/',
                        'message'=> 'Debe de tener el formato HH:mm'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Horario::class,
        ]);
    }
}
