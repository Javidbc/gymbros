<?php

namespace App\Form;

use App\Entity\Aparato;
use App\Entity\Ejercicio;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;

class EjercicioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre',TextType::class,[
                'label'=>'Nombre del Ejercicio'
            ])
            ->add('grupoMuscular',TextType::class,[
                'label'=>'Grupo Muscular que implica'
            ])
            ->add('descripcion',TextType::class,[
                'label'=>'Descripción del ejercicio'
            ])
            ->add('url',TextType::class,[
                'label'=>'Url del video explicativo'
            ])
            ->add('aparatos',EntityType::class,[
                'label'=>'Elige uno o varios aparatos al que asociarlo',
                'class'=>Aparato::class,
                'multiple'=>true
            ])
            /*->add('aparatos',Select2EntityType::class,[
                'label'=>'Elige uno o varios aparatos al que asociarlo',
                'class'=>Aparato::class,
                'multiple'=>true,
                'remote_route'=>'ejercicios_buscarAparatos',
                'placeholder'=>'selecciona los aparatos',
                'text_property'=>'nombreAparato'
            ])*/
            /*->add('dias')*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ejercicio::class,
        ]);
    }
}
