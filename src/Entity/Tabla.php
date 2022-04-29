<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table()
 */
class Tabla
{
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
}