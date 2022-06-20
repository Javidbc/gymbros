<?php

namespace App\Form;

use App\Entity\Aparato;
use App\Entity\Ejercicio;
use http\Url;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;

class EjercicioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre',TextType::class,[
                'label'=>'Nombre del Ejercicio',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 3,
                        'max'=>200,
                        'minMessage'=>'Debe de tener un mínimo de 3 caracteres',
                        'maxMessage'=>'Debe de tener un máximo de 200 caracteres'
                    ]),
                ]
            ])
            ->add('grupoMuscular',TextType::class,[
                'label'=>'Grupo Muscular que implica',
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
            ->add('descripcion',TextType::class,[
                'label'=>'Descripción breve del ejercicio',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 3,
                        'max'=>250,
                        'minMessage'=>'Debe de tener un mínimo de 3 caracteres',
                        'maxMessage'=>'Debe de tener un máximo de 250 caracteres'
                    ]),
                ]
            ])
            ->add('url',TextType::class,[
                'label'=>'Url del video explicativo',
                'required'=>false,
                'empty_data'  => "",
                'constraints' => [
                    new Length([
                        'min' => 3,
                        'max'=>250,
                        'minMessage'=>'Debe de tener un mínimo de 3 caracteres',
                        'maxMessage'=>'Debe de tener un máximo de 250 caracteres'
                    ]),
                ]
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
