<?php

namespace App\Controller;

use App\Repository\HorarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HorarioController extends AbstractController
{
    /**
     * @Route ("/horarios", name="horarios_listar")
     */
    public function verHorarios(HorarioRepository $horarioRepository):Response
    {
        $horarioRepository=$horarioRepository->verEjercicios();
        return  $this->render('Horario/VerHorarios.html.twig',['horarios'=>$horarioRepository]);
    }
}