<?php

namespace App\Controller;

use App\Entity\Reserva;
use App\Entity\Usuario;
use App\Form\ReservaType;
use App\Repository\ReservaRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservaController extends AbstractController
{
    /**
     * @Route ("reservas/nuevo/{usuario}", name="reservas_nuevo")
     * @Security("is_granted('ROLE_USER')")
     *
     */
    public function nuevaReserva(Request $request, ReservaRepository $reservaRepository,Usuario $usuario): Response
    {
        $reserva = $reservaRepository->nuevo();
        $reserva->setUsuario($usuario);
        return $this->modificarReserva($request,$reservaRepository,$reserva);
    }

    /**
     * @Route ("/reservas/modificar/{id}", name="reservas_modificar")
     * @Security("is_granted('ROLE_USER')")
     */
    public function modificarReserva(Request $request, ReservaRepository $reservaRepository, Reserva $reserva): Response
    {
        $form = $this->createForm(ReservaType::class, $reserva);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $reservaRepository->save();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('reservas_listar');
            } catch (\Exception $exception) {
                $this->addFlash('error', 'Error al guardar los cambios');
            }
        }
        return $this->render('Reserva/modificar.html.twig', [
            'reserva' => $reserva,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/reservas/eliminar/{id}", name="reservas_eliminar")
     * @Security("is_granted('ROLE_USER')")
     */

    public function eliminarReserva(Request $request, ReservaRepository $reservaRepository,Reserva $reserva):Response
    {
        if ($request->get('confirmar', false)) {
            try {
                $reservaRepository->delete($reserva);
                $this->addFlash('exito', 'Reserva eliminado con exito');
                return $this->redirectToRoute('reservas_listar');
            } catch (\Exception $exception) {
                $this->addFlash('error', 'Error al eliminar la reserva');
            }
        }
        return $this->render('Reserva/eliminar.html.twig', [
            'reserva' => $reserva
        ]);
    }

    /**
     * @Route ("/reservas", name="reservas_listar")
     * @Security("is_granted('ROLE_USER')")
     */
    public function verReservas(ReservaRepository $reservaRepository):Response
    {
        $reserva=$reservaRepository->verReservas();
        return  $this->render('Reserva/VerReservas.html.twig',['reservas'=>$reserva]);
    }
}