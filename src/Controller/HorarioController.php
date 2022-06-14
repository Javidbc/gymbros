<?php

namespace App\Controller;

use App\Entity\Horario;
use App\Form\HorarioType;
use App\Repository\HorarioRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HorarioController extends AbstractController
{
    /**
     * @Route ("/horarios/nuevo", name="horarios_nuevo")
     * @Security("is_granted('ROLE_USER')")
     */
    public function nuevoUsuario(Request $request, HorarioRepository $horarioRepository): Response
    {
        $horario = $horarioRepository->nuevo();
        return $this->modificarUsuario($request,$horarioRepository,$horario);
    }

    /**
     * @Route ("/horarios/modificar/{id}", name="horarios_modificar")
     * @Security("is_granted('ROLE_USER')")
     */
    public function modificarUsuario(Request $request,HorarioRepository $horarioRepository, Horario $horario): Response
    {
        $form = $this->createForm(HorarioType::class, $horario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $horarioRepository->save();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('horarios_listar');
            } catch (\Exception $exception) {
                $this->addFlash('error', 'Error al guardar los cambios');
            }
        }
        return $this->render('Horario/modificar.html.twig', [
            'horario' => $horario,
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route ("/horarios/eliminar/{id}", name="horarios_eliminar")
     * @Security("is_granted('ROLE_USER')")
     */

    public function eliminarUsuario(Request $request, HorarioRepository $horarioRepository,Horario $horario):Response
    {
        if ($request->get('confirmar', false)) {
            try {
                $horarioRepository->delete($horario);
                $this->addFlash('exito', 'Horario eliminado con exito');
                return $this->redirectToRoute('horarios_listar');
            } catch (\Exception $exception) {
                $this->addFlash('error', 'Error al eliminar el horario');
            }
        }
        return $this->render('Horario/eliminar.html.twig', [
            'horario' => $horario
        ]);
    }

    /**
     * @Route ("/horarios", name="horarios_listar")
     * @Security("is_granted('ROLE_USER')")
     */
    public function verHorarios(HorarioRepository $horarioRepository):Response
    {
        $horarioRepository=$horarioRepository->verHorarios();
        return  $this->render('Horario/VerHorarios.html.twig',['horarios'=>$horarioRepository]);
    }
}