<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrincipalController extends AbstractController
{
    /**
     * @Route ("/" , name="principal")
     */
    public function principal(): Response
    {
        return $this->render('Principal/Principal.html.twig');
    }
}
