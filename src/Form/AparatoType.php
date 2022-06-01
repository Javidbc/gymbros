<?php

namespace App\Form;

use App\Entity\Aparato;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AparatoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombreAparato',TextType::class,[
                'label'=>'Nombre del Aparato'
            ])
            ->add('reservable',CheckboxType::class,[
                'label'=>'¿Es reservable?',
                'required'=>false,
                'empty_data'  => null
            ])
            /*->add('ejercicios')*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Aparato::class,
        ]);
    }
}
