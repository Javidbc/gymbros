<?php

namespace App\Form;

use App\Entity\Dia;
use App\Entity\Tabla;
use App\Entity\Usuario;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class TablaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombreTabla',TextType::class,[
                'label'=>'Nombre de la tabla',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 3,
                        'max'=>50,
                        'minMessage'=>'Debe de tener un mínimo de 3 caracteres',
                        'maxMessage'=>'Utiliza un nombre más corto para tu tabla'
                    ]),
                ]
            ])
            /*->add('vistoBueno',CheckboxType::class,[
                'label'=>'Tabla recomendada?',
                'required'=>false,
                'empty_data'  => null
            ])*/
            /*->add('dias',EntityType::class,[
                'label'=>'Dia de la semana',
                'class'=>Dia::class
            ])
            ->add('creador',EntityType::class,[
                'label'=>'Creador',
                'class'=>Usuario::class,
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tabla::class,
        ]);
    }
}
