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
        $this->dias= new ArrayCollection();
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
    private $nombreTabla;

    /**
     * @ORM\Column (type="boolean")
     * @var boolean
     */
    private $vistoBueno;

    /**
     * @ORM\ManyToMany(targetEntity="Dia",inversedBy="tablas")
     * @var Dia[]|Collection
     */
    private  $dias;

    /**
     * @ORM\ManyToOne (targetEntity="Usuario",inversedBy="tablasCreadas")
     * @var Usuario
     */
    private $creador;

    /**
     * @ORM\OneToMany (targetEntity="Usuario",mappedBy="miTabla")
     * @var Usuario[]|Collection
     */
    private $usuarios;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getDiaSemana(): string
    {
        return $this->diaSemana;
    }

    /**
     * @param string $diaSemana
     * @return Tabla
     */
    public function setDiaSemana(string $diaSemana): Tabla
    {
        $this->diaSemana = $diaSemana;
        return $this;
    }

    /**
     * @return string
     */
    public function getNombreTabla(): string
    {
        return $this->nombreTabla;
    }

    /**
     * @param string $nombreTabla
     * @return Tabla
     */
    public function setNombreTabla(string $nombreTabla): Tabla
    {
        $this->nombreTabla = $nombreTabla;
        return $this;
    }

    /**
     * @return bool
     */
    public function isVistoBueno(): bool
    {
        return $this->vistoBueno;
    }

    /**
     * @param bool $vistoBueno
     * @return Tabla
     */
    public function setVistoBueno(bool $vistoBueno): Tabla
    {
        $this->vistoBueno = $vistoBueno;
        return $this;
    }

    /**
     * @return Ejercicio[]|Collection
     */
    public function getEjercicios()
    {
        return $this->ejercicios;
    }

    /**
     * @param Ejercicio[]|Collection $ejercicios
     * @return Tabla
     */
    public function setEjercicios($ejercicios)
    {
        $this->ejercicios = $ejercicios;
        return $this;
    }

    /**
     * @return Usuario
     */
    public function getCreador(): Usuario
    {
        return $this->creador;
    }

    /**
     * @param Usuario $creador
     * @return Tabla
     */
    public function setCreador(Usuario $creador): Tabla
    {
        $this->creador = $creador;
        return $this;
    }

    /**
     * @return Usuario[]|Collection
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * @param Usuario[]|Collection $usuarios
     * @return Tabla
     */
    public function setUsuarios($usuarios)
    {
        $this->usuarios = $usuarios;
        return $this;
    }


}