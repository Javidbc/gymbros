<?php

namespace App\Controller;

use App\Entity\Tabla;
use App\Repository\TablaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TablaController extends AbstractController
{
    /**
     * @Route ("tablas/nuevo", name="tablas_nuevo")
     *
     */
    public function nuevaTabla(Request $request, TablaRepository $tablaRepository): Response
    {
        $tabla = $tablaRepository->nuevo();
        return $this->modificarTabla($request,$tablaRepository,$tabla);
    }

    /**
     * @Route ("/tablas/modificar/{id}", name="tablas_modificar")
     */
    public function modificarTabla(Request $request, TablaRepository $tablaRepository, Tabla $tabla): Response
    {
        $form = $this->createForm(TablaType::class, $tabla);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $tablaRepository->save();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('tablas_listar');
            } catch (\Exception $exception) {
                $this->addFlash('error', 'Error al guardar los cambios');
            }
        }
        return $this->render('Tabla/modificar.html.twig', [
            'tabla' => $tabla,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/tablas/eliminar/{id}", name="tablas_eliminar")
     */

    public function eliminarTabla(Request $request, TablaRepository $tablaRepository,Tabla $tabla):Response
    {
        if ($request->get('confirmar', false)) {
            try {
                $tablaRepository->delete($tabla);
                $this->addFlash('exito', 'Tabla eliminada con exito');
                return $this->redirectToRoute('tablas_listar');
            } catch (\Exception $exception) {
                $this->addFlash('error', 'Error al eliminar la tabla');
            }
        }
        return $this->render('Tabla/eliminar.html.twig', [
            'tabla' => $tabla
        ]);
    }

    /**
     * @Route ("/tablas", name="tablas_listar")
     */
    public function verTablas(TablaRepository $tablaRepository):Response
    {
        $tablas=$tablaRepository->verTablas();
        return  $this->render('Tabla/VerTablas.html.twig',['tablas'=>$tablas]);
    }
}