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
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('repeticiones',IntegerType::class,[
                'label'=>'Numero de repeticiones',
                'constraints' => [
                    new NotBlank(),
                    new Range([
                        'min' => 0,
                        'max'=>50,
                        'minMessage'=>'No puede hacer un numero de repeticiones negativo',
                        'maxMessage'=>'No creo que hayas hecho más de 50 repeticiones, y si las has hecho, prueba a subir el peso'
                    ]),
                ]
            ])
            ->add('peso',NumberType::class,[
                'label'=>'Peso total de la serie',
                'constraints' => [
                    new NotBlank(),
                    new Range([
                        'min' => 0,
                        'max'=>500,
                        'minMessage'=>'No puedes introducir un peso negativo',
                        'maxMessage'=>'Recuerda que el peso es en Kg'
                    ]),
                ]
            ])
            ->add('numSerie',IntegerType::class,[
                'label'=>'Numero de serie',
                'constraints' => [
                    new NotBlank(),
                    new Range([
                        'min' => 0,
                        'max'=>15,
                        'minMessage'=>'No puedes hacer un numero negativo de series',
                        'maxMessage'=>'Ya llevas 15 series hechas, cambia de ejercicio'
                    ]),
                ]
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
