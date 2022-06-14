<?php

namespace App\Controller;

use App\Entity\Ejercicio;
use App\Entity\Serie;
use App\Entity\Tabla;
use App\Entity\Usuario;
use App\Form\SerieType;
use App\Repository\SerieRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SerieController extends AbstractController
{
    /**
     * @Route ("/series/nuevo/{usuario}/{ejercicio}", name="series_nueva")
     * @Security("is_granted('ROLE_USER')")
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
     * @Security("is_granted('ROLE_USER')")
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
     * @Security("is_granted('ROLE_USER')")
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
     * @Route ("/series/verSeries/{usuario}/{fecha}", name="series_miSerieFecha")
     * @Security("is_granted('ROLE_USER')")
     */
    public function verMiserieFecha(SerieRepository $serieRepository,string $usuario,string $fecha):Response
    {
        $serie=$serieRepository->verMisSeries($usuario,$fecha);
        return $this->render('Serie/verSerie.html.twig',['series'=>$serie]);
    }

    /**
     * @Route ("/series/verSeriesHoy/{usuario}/{fecha}/{ejercicio}", name="series_serieHoy")
     * @Security("is_granted('ROLE_USER')")
     */
    public function verSerieEjer(SerieRepository $serieRepository,string $usuario,string $fecha,string $ejercicio):Response
    {
        $serie=$serieRepository->seriesHoy($usuario,$fecha,$ejercicio);
        return $this->render('Serie/verSerieHoy.html.twig',['series'=>$serie]);
    }

    /**
     * @Route ("/calendario" , name="series_calendario")
     * @Security("is_granted('ROLE_USER')")
     */
    public function calendario() :Response
    {
        return $this->render('Serie/calendario.html.twig');
    }
}