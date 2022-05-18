<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table()
 */
class Tabla
{

    public function __construct()
    {
        $this->ejercicios= new ArrayCollection();
        $this->usuarios= new ArrayCollection();
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
    private $diaSemana;

    /**
     * @ORM\Column (type="string")
     * @var string
     */
    private $nombreTabla;

    /**
     * @ORM\Column (type="boolean")
     * @var boolean
     */
    private $vistoBueno;

    /**
     * @ORM\ManyToMany(targetEntity="Ejercicio",inversedBy="tablas")
     * @var Ejercicio[]|Collection
     */
    private  $ejercicios;

    /**
     * @ORM\ManyToOne (targetEntity="Usuario",inversedBy="tablasCreada")
     * @var Usuario
     */
    private $creador;

    /**
     * @ORM\OneToMany (targetEntity="Usuario",mappedBy="miTabla")
     * @var Usuario[]|Collection
     */
    private $usuarios;
}