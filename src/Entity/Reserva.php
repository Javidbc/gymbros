<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table()
 */

class Reserva
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column (type="datetime")
     * @var DateTime
     */
    private $fechaReserva;

    /**
     * @ORM\ManyToOne(targetEntity="Maquina",inversedBy="reservas")
     * @var Maquina
     */
    private $maquina;

    /**
     * @ORM\ManyToOne (targetEntity="Horario",inversedBy="reservasHora")
     * @var Horario
     */
    private $horario;

    /**
     * @ORM\ManyToOne (targetEntity="Usuario",inversedBy="reservasUsuario")
     * @var Usuario
     */
    private $usuario;



}