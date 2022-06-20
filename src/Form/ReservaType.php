<?php

namespace App\Form;

use App\Entity\Horario;
use App\Entity\Maquina;
use App\Entity\Reserva;
use App\Entity\Usuario;
use App\Repository\MaquinaRepository;
use App\Repository\ReservaRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class   ReservaType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('fechaReserva',DateType::class,[
                'label'=>'Fecha de la reserva',
                'html5'=>true,
                'widget'=>'single_text'
            ])
            ->add('maquina',EntityType::class,[
                'label'=>'Elige una maquina que reservar',
                'class'=>Maquina::class,
                /*'query_builder' => function (EntityRepository $er) {
                    $qb=$er->createQueryBuilder('m');
                    $busqueda=$er->createQueryBuilder('m2');
                    $busqueda->where('m2.fecha = 2017-01-01')
                    ->andWhere('m2.horario = 1');
                    $noEstan=$qb->expr()->notIn('m',$busqueda);
                    return $noEstan;
                },*/

            ])
            ->add('horario',EntityType::class,[
                'label'=>'Elige el horario que quieres reservar',
                'class'=>Horario::class,
            ]);
            /*->add('usuario',EntityType::class,[
                'label'=>'Usuario de la reserva',
                'class'=>Usuario::class,
            ])*/

    }

    public function __toString(){

        return $this->getParent();
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reserva::class,
        ]);
    }
}
