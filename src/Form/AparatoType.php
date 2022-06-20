<?php

namespace App\Form;

use App\Entity\Aparato;
use App\Entity\Ejercicio;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class AparatoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombreAparato',TextType::class,[
                'label'=>'Nombre del Aparato',
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
            ->add('reservable',CheckboxType::class,[
                'label'=>'¿Es reservable?',
                'required'=>false,
                'empty_data'  => null
            ])
            /* no se pueden añadir ejercicios a traves de aparatos
             * ->add('ejercicios',EntityType::class,[
                'label'=>'Elige un ejercicio o varios con los que relacionarlo',
                'class'=>Ejercicio::class,
                'multiple'=>true
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Aparato::class,
        ]);
    }
}
