<?php

namespace App\Form;

use App\Entity\Ejercicio;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EjercicioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre',TextType::class,[
                'label=>Nombre del Ejercicio'
            ])
            ->add('grupoMuscular',TextType::class,[
                'label=>Grupo Muscular que implica'
            ])
            ->add('descripcion',TextType::class,[
                'label=>Descripción del ejercicio'
            ])
            ->add('url',TextType::class,[
                'label=>Url del video explicativo'
            ])
            /*->add('aparatos')
            ->add('tablas')*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ejercicio::class,
        ]);
    }
}
