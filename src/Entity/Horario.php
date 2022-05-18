<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table()
 */

class Horario
{
    public function  __construct()
    {
        $this->reservasHora = new ArrayCollection();
    }
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column (type="string")
     * @var string
     */
    private $hora;

    /**
     * @ORM\OneToMany (targetEntity="Reserva",mappedBy="horario")
     * @var Reserva[]|Collection
     */
    private $reservasHora;



}