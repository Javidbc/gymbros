<?php

namespace App\Controller;

use App\Entity\Aparato;
use App\Form\AparatoType;
use App\Repository\AparatoRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AparatoController extends AbstractController
{
    /**
     * @Route ("/aparatos/nuevo", name="aparatos_nuevo")
     *@Security("is_granted('ROLE_ADMIN')")
     */
    public function nuevoAparato(Request $request, AparatoRepository $aparatoRepository): Response
    {
        $aparato = $aparatoRepository->nuevo();
        return $this->modificarAparato($request,$aparatoRepository,$aparato);
    }

    /**
     * @Route ("/aparatos/modificar/{id}", name="aparatos_modificar")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function modificarAparato(Request $request,AparatoRepository $aparatoRepository, Aparato $aparato): Response
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
     * @Security("is_granted('ROLE_ADMIN')")
     */

    public function eliminarAparato(Request $request, AparatoRepository $aparatoRepository,Aparato $aparato):Response
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
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function verAparatos( AparatoRepository $aparatoRepository):Response
    {
        $aparatoRepository=$aparatoRepository->verAparatos();
        return $this->render('Aparato/VerAparatos.html.twig',['aparatos'=>$aparatoRepository]);
    }

    /**
     * @Route ("/aparatos/reservable/{id}", name="aparatos_cambRes")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function cambiaReservable(AparatoRepository $aparatoRepository, Aparato $aparato):Response
    {
        $estado=$aparato->isReservable();
        if ($estado){
            $aparato->setReservable(false);
        }
        else{
            $aparato->setReservable(true);
        }
        $aparatoRepository->save();


        return $this->redirectToRoute("aparatos_listar");
    }

    /**
     * @Route ("/ejercicios/aparatos" , name="ejercicios_buscarAparatos")
     * @Security("is_granted('ROLE_USER')")
     */
    public function buscarAparatos(Request $request,AparatoRepository $aparatoRepository):Response
    {
        $busqueda=$request->get('q');
        $aparatos=$aparatoRepository->recogerAparatos($busqueda);

        $datos = [];
        foreach ($aparatos as $aparato){
            $datos[]=['id'=>$aparato->getId(),'text'=>$aparato->getNombreAparato()];
        }

        return new JsonResponse($datos);
    }
}