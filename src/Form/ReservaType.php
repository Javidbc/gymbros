<?php

namespace App\Form;

use App\Entity\Horario;
use App\Entity\Maquina;
use App\Entity\Reserva;
use App\Entity\Usuario;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class   ReservaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fechaReserva',DateType::class,[
                'label'=>'Fecha de la reserva',
                'html5'=>true
            ])
            ->add('maquina',EntityType::class,[
                'label'=>'Elige una maquina que reservar',
                'class'=>Maquina::class,
            ])
            ->add('horario',EntityType::class,[
                'label'=>'Elige el horario que quieres reservar',
                'class'=>Horario::class,
            ])
            /*->add('usuario',EntityType::class,[
                'label'=>'Usuario de la reserva',
                'class'=>Usuario::class,
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reserva::class,
        ]);
    }
}
