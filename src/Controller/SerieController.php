<?php

namespace App\Controller;

use App\Entity\Ejercicio;
use App\Entity\Serie;
use App\Entity\Tabla;
use App\Entity\Usuario;
use App\Form\SerieType;
use App\Repository\SerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SerieController extends AbstractController
{
    /**
     * @Route ("/series/nuevo/{usuario}/{ejercicio}", name="series_nueva")
     *
     */
    public function nuevaSerie(Request $request, SerieRepository $serieRepository, Usuario $usuario,Ejercicio $ejercicio): Response
    {
        $serie = $serieRepository->nuevo();
        $serie->setUsuario($usuario);
        $serie->setEjercicio($ejercicio);
        $serie->setFechaSerie(\DateTime::createFromFormat('Y-m-d',date('Y-m-d')));
        // esto no va $serie->setNumSerie($serie->getNumSerie()+1);
        return $this->modificarSerie($request,$serieRepository,$serie);
    }

    /**
     * @Route ("/series/modificar/{id}", name="series_modificar")
     */
    public function modificarSerie(Request $request,SerieRepository $serieRepository, Serie $serie): Response
    {
        $form = $this->createForm(SerieType::class, $serie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $serieRepository->save();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('usuarios_miTabla',array(
                    'tabla'=>$serie->getUsuario(),
                    'id'=>$serie->getUsuario()->getMiTabla()
                ));
            } catch (\Exception $exception) {
                $this->addFlash('error', 'Error al guardar los cambios');
            }
        }
        return $this->render('Serie/Modificar.html.twig', [
            'serie' => $serie,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/series/eliminar/{id}", name="series_eliminar")
     */

    public function eliminarDia(Request $request, SerieRepository $serieRepository,Serie $serie):Response
    {
        if ($request->get('confirmar', false)) {
            try {
                $serieRepository->delete($serie);
                $this->addFlash('exito', 'Serie eliminada con exito');
                return $this->redirectToRoute('tablas_listar');
            } catch (\Exception $exception) {
                $this->addFlash('error', 'Error al eliminar la serie');
            }
        }
        return $this->render('Serie/Eliminar.html.twig', [
            'serie' => $serie
        ]);
    }

    /**
     * @Route ("/series/verSeries/{usuario}/{dia}", name="series_miSerieFecha")
     */
    public function verMiserieFecha(SerieRepository $serieRepository,string $fecha,string $usuario,string $serie):Response
    {
        $serie=$serieRepository->verMisSeries($fecha,$usuario);
        return $this->render('Serie/verSerie.html.twig',['serie'=>$serie]);
    }

    /**
     * @Route ("/calendario" , name="series_calendario")
     */
    public function calendario() :Response
    {
        return $this->render('Series/calendario.html.twig');
    }
}