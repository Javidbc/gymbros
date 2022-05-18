<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table()
 */

class Maquina
{
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
}