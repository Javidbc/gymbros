<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table()
 */

class Maquina
{

    public function  __construct()
    {
        $this->reservas = new ArrayCollection();

    }
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $numeroMaquina;

    /**
     * @ORM\ManyToOne(targetEntity="Aparato",inversedBy="maquinas")
     * @var Aparato
     */
    private $aparato;

    /**
     * @ORM\OneToMany (targetEntity="Reserva",mappedBy="maquina")
     * @var Reserva[]|Collection
     */
    private $reservas;
}