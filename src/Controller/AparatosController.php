<?php

namespace App\Controller;

use App\Repository\AparatoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AparatosController extends AbstractController
{
    /**
     * @Route ("/aparatos",name="aparatos_listar")
     */
    public function verAparatos( AparatoRepository $aparatoRepository):Response
    {
        $aparatoRepository=$aparatoRepository->verAparatos();
        return $this->render('Aparato/VerAparatos.html.twig',['aparatos'=>$aparatoRepository]);
    }
}