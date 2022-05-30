<?php

namespace App\Controller;

use App\Repository\EjercicioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EjercicioController extends AbstractController
{

    /**
     * @Route ("/ejercicios", name="ejercicio_nombre")
     */
    public function verEjercicios(EjercicioRepository $ejercicioRepository):Response
    {
        $ejercicioRepository=$ejercicioRepository->verEjercicios();
        return  $this->render('Ejercicio/VerEjercicios.html.twig',['ejercicios'=>$ejercicioRepository]);
    }
}