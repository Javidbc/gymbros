<?php

namespace App\Controller;

use App\Repository\UsuarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsuarioController extends AbstractController
{
    /**
     * @Route ("/usuarios", name="usuarios_listar")
     */
    public function verEjercicios(UsuarioRepository $usuarioRepository):Response
    {
        $usuarioRepository=$usuarioRepository->verUsuarios();
        return  $this->render('Usuario/VerUsuarios.html.twig',['usuarios'=>$usuarioRepository]);
    }
}