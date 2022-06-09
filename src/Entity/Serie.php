<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

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
     * @ORM\Column(type="date")
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

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return int
     */
    public function getRepeticiones(): ?int
    {
        return $this->repeticiones;
    }

    /**
     * @param int $repeticiones
     * @return Serie
     */
    public function setRepeticiones(int $repeticiones): Serie
    {
        $this->repeticiones = $repeticiones;
        return $this;
    }

    /**
     * @return float
     */
    public function getPeso(): ?float
    {
        return $this->peso;
    }

    /**
     * @param float $peso
     * @return Serie
     */
    public function setPeso(float $peso): Serie
    {
        $this->peso = $peso;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumSerie(): ?int
    {
        return $this->numSerie;
    }

    /**
     * @param int $numSerie
     * @return Serie
     */
    public function setNumSerie(int $numSerie): Serie
    {
        $this->numSerie = $numSerie;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getFechaSerie(): ?\DateTime
    {
        return $this->fechaSerie;
    }

    /**
     * @param \DateTime $fechaSerie
     * @return Serie
     */
    public function setFechaSerie(\DateTime $fechaSerie): Serie
    {
        $this->fechaSerie = $fechaSerie;
        return $this;
    }

    /**
     * @return Ejercicio
     */
    public function getEjercicio(): ?Ejercicio
    {
        return $this->ejercicio;
    }

    /**
     * @param Ejercicio $ejercicio
     * @return Serie
     */
    public function setEjercicio(Ejercicio $ejercicio): Serie
    {
        $this->ejercicio = $ejercicio;
        return $this;
    }

    /**
     * @return Usuario
     */
    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    /**
     * @param Usuario $usuario
     * @return Serie
     */
    public function setUsuario(Usuario $usuario): Serie
    {
        $this->usuario = $usuario;
        return $this;
    }


}