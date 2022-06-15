<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\User\UserInterface;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity()
 * @ORM\Table()
 * @Vich\Uploadable
 */

class Usuario implements UserInterface
{
    public function  __construct()
    {
        $this->series=new ArrayCollection();
        $this->reservasUsuario = new ArrayCollection();
        $this->tablasCreadas = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getNombre() . ' ' . $this->getApellidos();
    }
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=9, unique=true)
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
     * @ORM\Column(type="string", length=15)
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
     * @ORM\Column(type="string")
     */
    private $brochureFilename;

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

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getDni(): ?string
    {
        return $this->dni;
    }

    /**
     * @param string $dni
     * @return Usuario
     */
    public function setDni(string $dni): Usuario
    {
        $this->dni = $dni;
        return $this;
    }

    /**
     * @return string
     */
    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     * @return Usuario
     */
    public function setNombre(string $nombre): Usuario
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return string
     */
    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    /**
     * @param string $apellidos
     * @return Usuario
     */
    public function setApellidos(string $apellidos): Usuario
    {
        $this->apellidos = $apellidos;
        return $this;
    }

    /**
     * @return string
     */
    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    /**
     * @param string $telefono
     * @return Usuario
     */
    public function setTelefono(string $telefono): Usuario
    {
        $this->telefono = $telefono;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getFechaNacimiento(): ?\DateTime
    {
        return $this->fechaNacimiento;
    }

    /**
     * @param \DateTime $fechaNacimiento
     * @return Usuario
     */
    public function setFechaNacimiento(\DateTime $fechaNacimiento): ?Usuario
    {
        $this->fechaNacimiento = $fechaNacimiento;
        return $this;
    }

    /**
     * @return string
     */
    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    /**
     * @param string $correo
     * @return Usuario
     */
    public function setCorreo(string $correo): Usuario
    {
        $this->correo = $correo;
        return $this;
    }

    /**
     * @return string
     */
    public function getContrasenia(): ?string
    {
        return $this->contrasenia;
    }

    /**
     * @param string $contrasenia
     * @return Usuario
     */
    public function setContrasenia(string $contrasenia): Usuario
    {
        $this->contrasenia = $contrasenia;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBrochureFilename()
    {
        return $this->brochureFilename;
    }

    /**
     * @param mixed $brochureFilename
     * @return Usuario
     */
    public function setBrochureFilename($brochureFilename)
    {
        $this->brochureFilename = $brochureFilename;
        return $this;
    }



    /**
     * @return bool
     */
    public function isActivado(): ?bool
    {
        return $this->activado;
    }

    /**
     * @param bool $activado
     * @return Usuario
     */
    public function setActivado(bool $activado): Usuario
    {
        $this->activado = $activado;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEsAdmin(): ?bool
    {
        return $this->esAdmin;
    }

    /**
     * @param bool $esAdmin
     * @return Usuario
     */
    public function setEsAdmin(bool $esAdmin): Usuario
    {
        $this->esAdmin = $esAdmin;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEsMonitor(): ?bool
    {
        return $this->esMonitor;
    }

    /**
     * @param bool $esMonitor
     * @return Usuario
     */
    public function setEsMonitor(bool $esMonitor): Usuario
    {
        $this->esMonitor = $esMonitor;
        return $this;
    }

    /**
     * @return Serie[]|Collection
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * @param Serie[]|Collection $series
     * @return Usuario
     */
    public function setSeries($series)
    {
        $this->series = $series;
        return $this;
    }

    /**
     * @return Usuario[]|Collection
     */
    public function getReservasUsuario()
    {
        return $this->reservasUsuario;
    }

    /**
     * @param Usuario[]|Collection $reservasUsuario
     * @return Usuario
     */
    public function setReservasUsuario($reservasUsuario)
    {
        $this->reservasUsuario = $reservasUsuario;
        return $this;
    }

    /**
     * @return Tabla[]|Collection
     */
    public function getTablasCreadas()
    {
        return $this->tablasCreadas;
    }

    /**
     * @param Tabla[]|Collection $tablasCreadas
     * @return Usuario
     */
    public function setTablasCreadas($tablasCreadas)
    {
        $this->tablasCreadas = $tablasCreadas;
        return $this;
    }

    /**
     * @return Tabla
     */
    public function getMiTabla(): ?Tabla
    {
        return $this->miTabla;
    }

    /**
     * @param Tabla $miTabla
     * @return Usuario
     */
    public function setMiTabla(Tabla $miTabla): Usuario
    {
        $this->miTabla = $miTabla;
        return $this;
    }


    public function getRoles()
    {
        $roles = ["ROLE_USER"];

        if ($this->isEsMonitor()) {
            $roles[] = "ROLE_MONITOR";
        }

        if ($this->isEsAdmin()) {
            $roles[] = "ROLE_ADMIN";
        }

        return $roles;

    }

    public function getPassword()
    {
        return $this->getContrasenia();
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->getCorreo();
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}