<?php

namespace App\Controller;

use App\Entity\Tabla;
use App\Entity\Usuario;
use App\Form\TablaType;
use App\Repository\TablaRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TablaController extends AbstractController
{
    /**
     * @Route ("tablas/nuevo/{creador}", name="tablas_nueva")
     * @Security("is_granted('ROLE_USER')")
     */
    public function nuevaTabla(Request $request, TablaRepository $tablaRepository,Usuario $creador): Response
    {
        $tabla = $tablaRepository->nuevo();
        $tabla->setCreador($creador);
        return $this->modificarTabla($request,$tablaRepository,$tabla,$creador);
    }

    /**
     * @Route ("/tablas/modificar/{id}/{usuario}", name="tablas_modificar")
     * @Security("is_granted('ROLE_USER')")
     */
    public function modificarTabla(Request $request, TablaRepository $tablaRepository, Tabla $tabla, Usuario $usuario): Response
    {
        $form = $this->createForm(TablaType::class, $tabla);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $tablaRepository->save();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                if($usuario->isEsMonitor()){
                return $this->redirectToRoute('tablas_listar');
                }
                else{
                    return $this->redirectToRoute('tablas_listarUser',['usuario'=>$usuario->getId()]);
                }
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
     * @Route ("/tablas/eliminar/{id}/{usuario}", name="tablas_eliminar")
     * @Security("is_granted('ROLE_USER')")
     */

    public function eliminarTabla(Request $request, TablaRepository $tablaRepository,Tabla $tabla,Usuario $usuario):Response
    {
        if ($request->get('confirmar', false)) {
            try {
                $tablaRepository->delete($tabla);
                $this->addFlash('exito', 'Tabla eliminada con exito');

                if($usuario->isEsMonitor()==true)
                    return $this->redirectToRoute('tablas_listar');
                else
                    return $this->redirectToRoute('tablas_listarUser',['usuario'=>$usuario->getId()]);

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
     * @Security("is_granted('ROLE_MONITOR')")
     */
    public function verTablas(TablaRepository $tablaRepository):Response
    {
        $tablas=$tablaRepository->verTablas();
        return  $this->render('Tabla/VerTablas.html.twig',['tablas'=>$tablas]);
    }

    /**
     * @Route ("/tablas/{usuario}", name="tablas_listarUser")
     * @Security("is_granted('ROLE_USER')")
     */
    public function verTablasUser(TablaRepository $tablaRepository, string $usuario):Response
    {
        $tablas=$tablaRepository->verTablasUser($usuario);
        return  $this->render('Tabla/VerTablas.html.twig',['tablas'=>$tablas]);
    }

    /**
     * @Route ("/tabla/verTabla/{tabla}", name="tablas_verTabla")
     * @Security("is_granted('ROLE_USER')")
     */
    public function verTabla(TablaRepository $tablaRepository,string $tabla): Response
    {
        $tabla=$tablaRepository->verTabla($tabla);
        return $this->render('Tabla/verTabla.html.twig',['tabla'=>$tabla]);
    }

    /**
     * @Route ("/tablas/recomentar/{id}", name="tablas_recomendar")
     * @Security("is_granted('ROLE_MONITOR')")
     */
    public function cambiaRecomendable(TablaRepository $tablaRepository, Tabla $tabla):Response
    {
        $estado=$tabla->isVistoBueno();
        if ($estado){
            $tabla->setVistoBueno(false);
        }
        else{
            $tabla->setVistoBueno(true);
        }
        $tablaRepository->save();


        return $this->redirectToRoute("tablas_listar");
    }


}