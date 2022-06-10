<?php

namespace App\Form;

use App\Entity\Serie;

use Doctrine\DBAL\Types\FloatType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('repeticiones',IntegerType::class,[
                'label'=>'Numero de repeticiones'
            ])
            ->add('peso',NumberType::class,[
                'label'=>'Peso total'
            ])
            ->add('numSerie',IntegerType::class,[
                'label'=>'Numero de serie'
            ])
            /*->add('fechaSerie',DateType::class,[
                'label'=>'Fecha de hoy'
            ])
            ->add('ejercicio')
            ->add('usuario')*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Serie::class,
        ]);
    }
}
