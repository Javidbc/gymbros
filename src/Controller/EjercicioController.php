<?php

namespace App\Controller;

use App\Entity\Ejercicio;
use App\Entity\Aparato;
use App\Form\EjercicioType;
use App\Repository\AparatoRepository;
use App\Repository\EjercicioRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EjercicioController extends AbstractController
{

    /**
     * @Route ("ejercicios/nuevo", name="ejercicios_nuevo")
     * @Security("is_granted('ROLE_MONITOR')")
     */
    public function nuevoEjercicio(Request $request, EjercicioRepository $ejercicioRepository): Response
    {
        $ejercicio = $ejercicioRepository->nuevo();
        return $this->modificarEjercicio($request,$ejercicioRepository,$ejercicio);
    }

    /**
     * @Route ("/ejercicios/modificar/{id}", name="ejercicios_modificar")
     * @Security("is_granted('ROLE_MONITOR')")
     */
    public function modificarEjercicio(Request $request, EjercicioRepository $ejercicioRepository, Ejercicio $ejercicio): Response
    {
        $form = $this->createForm(EjercicioType::class, $ejercicio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $ejercicioRepository->save();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('ejercicios_listar');
            } catch (\Exception $exception) {
                $this->addFlash('error', 'Error al guardar los cambios');
            }
        }
        return $this->render('Ejercicio/modificar.html.twig', [
            'ejercicio' => $ejercicio,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/ejercicios/eliminar/{id}", name="ejercicios_eliminar")
     * @Security("is_granted('ROLE_MONITOR')")
     */

    public function eliminarEjercicio(Request $request, EjercicioRepository $ejercicioRepository,Ejercicio $ejercicio):Response
    {
        if ($request->get('confirmar', false)) {
            try {
                $ejercicioRepository->delete($ejercicio);
                $this->addFlash('exito', 'Ejercicio eliminado con exito');
                return $this->redirectToRoute('ejercicios_listar');
            } catch (\Exception $exception) {
                $this->addFlash('error', 'Error al eliminar el ejercicio');
            }
        }
        return $this->render('Ejercicio/eliminar.html.twig', [
            'ejercicio' => $ejercicio
        ]);
    }

    /**
     * @Route ("/ejercicios", name="ejercicios_listar")
     * @Security("is_granted('ROLE_USER')")
     */
    public function verEjercicios(EjercicioRepository $ejercicioRepository):Response
    {
        $ejercicios=$ejercicioRepository->verEjercicios();
        $gruposMusculares=$ejercicioRepository->sacarGruposMusculares();
        return  $this->render('Ejercicio/VerEjercicios.html.twig',['ejercicios'=>$ejercicios,'grupos'=>$gruposMusculares]);
    }

    /**
     * @Route ("/dia/ejercicios" , name="dias_buscarEjercicios")
     * @Security("is_granted('ROLE_USER')")
     */
    public function buscarEjercicios(Request $request,EjercicioRepository $ejercicioRepository):Response
    {
        $busqueda=$request->get('q');
        $ejercicios=$ejercicioRepository->recogerEjercicios($busqueda);

        $datos = [];
        foreach ($ejercicios as $ejercicio){
            $datos[]=['id'=>$ejercicio->getId(),'text'=>$ejercicio->getNombre()];
        }

        return new JsonResponse($datos);
    }




}