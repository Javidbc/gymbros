<?php

namespace App\Controller;

use App\Entity\Dia;
use App\Entity\Tabla;
use App\Form\DiaType;
use App\Repository\DiaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DiaController extends AbstractController
{
    /**
     * @Route ("/dias/nuevo/{tabla}", name="dias_nuevo")
     *
     */
    public function nuevoDia(Request $request, DiaRepository $diaRepository,Tabla $tabla): Response
    {
        $dia = $diaRepository->nuevo();
        $dia->setTablas($tabla);
        return $this->modificarDia($request,$diaRepository,$dia);
    }

    /**
     * @Route ("/dias/modificar/{id}", name="dias_modificar")
     */
    public function modificarDia(Request $request,DiaRepository $diaRepository, Dia $dia): Response
    {
        $form = $this->createForm(DiaType::class, $dia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $diaRepository->save();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('tablas_listar');
            } catch (\Exception $exception) {
                $this->addFlash('error', 'Error al guardar los cambios');
            }
        }
        return $this->render('Dia/Modificar.html.twig', [
            'dia' => $dia,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/dias/eliminar/{id}", name="dias_eliminar")
     */

    public function eliminarDia(Request $request, DiaRepository $diaRepository,Dia $dia):Response
    {
        if ($request->get('confirmar', false)) {
            try {
                $diaRepository->delete($dia);
                $this->addFlash('exito', 'Dia eliminado con exito');
                return $this->redirectToRoute('tablas_listar');
            } catch (\Exception $exception) {
                $this->addFlash('error', 'Error al eliminar el dia');
            }
        }
        return $this->render('Dia/Eliminar.html.twig', [
            'dia' => $dia
        ]);
    }

    /**
     * @Route ("/dia",name="dias_listar")
     */
    public function verDias(DiaRepository $diaRepository):Response
    {
        $diaRepository=$diaRepository->verDias();
        return $this->render('Dia/VerDias.html.twig',['dias'=>$diaRepository]);
    }
}