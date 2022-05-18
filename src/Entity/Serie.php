<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table()
 */

class Serie
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
    private $repeticiones;

    /**
     * @ORM\Column(type="float")
     * @var float
     */
    private $peso;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $numSerie;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $fechaSerie;

    /**
     * @ORM\ManyToOne(targetEntity="Ejercicio",inversedBy="series")
     * @ORM\JoinColumn(nullable=false)
     * @var Ejercicio
     */
    private $ejercicio;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario",inversedBy="series")
     * @ORM\JoinColumn(nullable=false)
     * @var Usuario
     */
    private $usuario;


}