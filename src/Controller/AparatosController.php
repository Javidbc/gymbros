<?php

namespace App\Controller;

use App\Entity\Aparato;
use App\Form\AparatoType;
use App\Repository\AparatoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AparatosController extends AbstractController
{
    /**
     * @Route ("/aparatos/nuevo", name="aparatos_nuevo")
     *
     */
    public function nuevoUsuario(Request $request, AparatoRepository $aparatoRepository): Response
    {
        $aparato = $aparatoRepository->nuevo();
        return $this->modificarUsuario($request,$aparatoRepository,$aparato);
    }

    /**
     * @Route ("/aparatos/modificar/{id}", name="aparatos_modificar")
     */
    public function modificarUsuario(Request $request,AparatoRepository $aparatoRepository, Aparato $aparato): Response
    {
        $form = $this->createForm(AparatoType::class, $aparato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $aparatoRepository->save();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('aparatos_listar');
            } catch (\Exception $exception) {
                $this->addFlash('error', 'Error al guardar los cambios');
            }
        }
        return $this->render('Aparato/Modificar.html.twig', [
            'aparato' => $aparato,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/aparatos/eliminar/{id}", name="aparatos_eliminar")
     */

    public function eliminarUsuario(Request $request, AparatoRepository $aparatoRepository,Aparato $aparato):Response
    {
        if ($request->get('confirmar', false)) {
            try {
                $aparatoRepository->delete($aparato);
                $this->addFlash('exito', 'Aparato eliminado con exito');
                return $this->redirectToRoute('aparatos_listar');
            } catch (\Exception $exception) {
                $this->addFlash('error', 'Error al eliminar el aparato');
            }
        }
        return $this->render('Aparato/Eliminar.html.twig', [
            'aparato' => $aparato
        ]);
    }

    /**
     * @Route ("/aparatos",name="aparatos_listar")
     */
    public function verAparatos( AparatoRepository $aparatoRepository):Response
    {
        $aparatoRepository=$aparatoRepository->verAparatos();
        return $this->render('Aparato/VerAparatos.html.twig',['aparatos'=>$aparatoRepository]);
    }
}