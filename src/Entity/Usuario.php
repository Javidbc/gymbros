<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table()
 */

class Usuario
{
    public function  __construct()
    {
        $this->series=new ArrayCollection();
        $this->reservasUsuario = new ArrayCollection();
        $this->tablasCreadas = new ArrayCollection();
    }
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=8, unique=true)
     * @var string
     */
    private $dni;

    /**
     * @ORM\Column(type="string", length=50)
     * @var string
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=50)
     * @var string
     */
    private $apellidos;

    /**
     * @ORM\Column(type="string", length=9)
     * @var string
     */
    private $telefono;

    /**
     * @ORM\Column (type="datetime")
     * @var \DateTime
     */
    private $fechaNacimiento;

    /**
     * @ORM\Column(type="string", length=50)
     * @var string
     */
    private $correo;

    /**
     * @ORM\Column(type="string", length=50)
     * @var string
     */
    private $contrasenia;

    /**
     * @ORM\Column(type="blob")
     * @var resource
     */
    private $foto;

    /**
     * @ORM\Column(type="boolean")
     * @var boolean
     */
    private $activado;

    /**
     * @ORM\Column(type="boolean")
     * @var boolean
     */
    private $esAdmin;

    /**
     * @ORM\Column(type="boolean")
     * @var boolean
     */
    private $esMonitor;

    /**
     * @ORM\OneToMany(targetEntity="Serie", mappedBy="usuario")
     * @var Serie[]|Collection
     */
    private $series;

    /**
     * @ORM\OneToMany (targetEntity="Reserva",mappedBy="usuario")
     * @var Usuario[]|Collection
     */
    private $reservasUsuario;

    /**
     * @ORM\OneToMany (targetEntity="Tabla",mappedBy="creador")
     * @var Tabla[]|Collection
     */
    private $tablasCreadas;

    /**
     * @ORM\ManyToOne  (targetEntity="Tabla",inversedBy="usuarios")
     * @var Tabla
     */
    private $miTabla;




}