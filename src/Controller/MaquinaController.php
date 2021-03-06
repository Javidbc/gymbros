<?php

namespace App\Controller;

use App\Entity\Aparato;
use App\Entity\Maquina;
use App\Form\MaquinaType;
use App\Repository\MaquinaRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaquinaController extends AbstractController
{
    /**
     * @Route ("maquinas/nueva/{aparato}", name="maquinas_nueva")
     * @Security("is_granted('ROLE_USER')")
     */
    public function nuevaMaquina(Request $request, MaquinaRepository $maquinaRepository,Aparato $aparato): Response
    {
        $maquina = $maquinaRepository->nuevo();
        $maquina->setAparato($aparato);
        return $this->modificarMaquina($request,$maquinaRepository,$maquina);
    }


    /**
     * @Route ("/maquinas/modificar/{id}", name="maquinas_modificar")
     * @Security("is_granted('ROLE_USER')")
     */
    public function modificarMaquina(Request $request, MaquinaRepository $maquinaRepository, Maquina $maquina): Response
    {
        $form = $this->createForm(MaquinaType::class, $maquina);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $maquinaRepository->save();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('aparatos_listar');
            } catch (\Exception $exception) {
                $this->addFlash('error', 'Error al guardar los cambios');
            }
        }
        return $this->render('Aparato/verAparato.html.twig', [
            'maquina' => $maquina,
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route ("/maquinas/eliminar/{id}", name="maquinas_eliminar")
     * @Security("is_granted('ROLE_USER')")
     */

    public function eliminarMaquina(Request $request, MaquinaRepository $maquinaRepository,Maquina $maquina):Response
    {
        if ($request->get('confirmar', false)) {
            try {
                $maquinaRepository->delete($maquina);
                $this->addFlash('exito', 'Maquina eliminada con exito');
                return $this->redirectToRoute('maquinas_listar');
            } catch (\Exception $exception) {
                $this->addFlash('error', 'Error al eliminar la maquina');
            }
        }
        return $this->render('Maquina/eliminar.html.twig', [
            'maquina' => $maquina
        ]);
    }

    /**
     * @Route ("/maquinas", name="maquinas_listar")
     * @Security("is_granted('ROLE_USER')")
     */
    public function verMaquinas(MaquinaRepository $maquinaRepository):Response
    {
        $maquinaRepository=$maquinaRepository->verMaquinas();
        return  $this->render('Maquina/VerMaquinas.html.twig',['maquinas'=>$maquinaRepository]);
    }
}