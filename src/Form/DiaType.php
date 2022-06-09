<?php

namespace App\Form;

use App\Entity\Dia;
use App\Entity\Ejercicio;
use App\Entity\Tabla;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DiaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('diaSemana',ChoiceType::class,[
                'choices'  => [
                    'Lunes' => 'Lunes',
                    'Martes' => 'Martes',
                    'Miércoles' => 'Miercoles',
                    'Jueves' => 'Jueves',
                    'Viernes' => 'Viernes',
                    'Sábado' => 'Sabado',
                    'Domingo' => 'Domingo',
                ],
            ])
            /*->add('tablas',EntityType::class,[
                'label'=>'Tabla asociada',
                'class'=>Tabla::class,
                'multiple'=>true
            ])*/
            ->add('ejercicios',EntityType::class,[
                'label'=>'Elige tus ejercicios',
                'class'=>Ejercicio::class,
                'multiple'=>true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dia::class,
        ]);
    }
}
