<?php

namespace App\Controller;

use App\Entity\Tabla;
use App\Entity\Usuario;
use App\Form\PerfilType;
use App\Form\UsuarioType;
use App\Repository\UsuarioRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsuarioController extends AbstractController
{

    /**
     * @Route ("/usuarios/nuevo", name="usuarios_nuevo")
     *
     */
    public function nuevoUsuario(Request $request, UsuarioRepository $usuarioRepository): Response
    {
        $usuario = $usuarioRepository->nuevo();
        return $this->modificarUsuario($request,$usuarioRepository,$usuario);
    }

    /**
     * @Route ("/usuarios/modificar/{id}", name="usuarios_modificar")
     */
    public function modificarUsuario(Request $request,UsuarioRepository $usuarioRepository, Usuario $usuario): Response
    {
        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $usuarioRepository->save();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('usuarios_listar');
            } catch (\Exception $exception) {
                $this->addFlash('error', 'Error al guardar los cambios');
            }
        }
        return $this->render('Usuario/modificar.html.twig', [
            'usuario' => $usuario,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/usuarios/perfil/{id}", name="usuarios_perfil")
     */
    public function modificarPerfil(Request $request,UsuarioRepository $usuarioRepository, Usuario $usuario): Response
    {
        $form = $this->createForm(PerfilType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $usuarioRepository->save();
                $this->addFlash('exito', 'Cambios guardados con éxito');
                return $this->redirectToRoute('principal');
            } catch (\Exception $exception) {
                $this->addFlash('error', 'Error al guardar los cambios');
            }
        }
        return $this->render('Usuario/perfil.html.twig', [
            'usuario' => $usuario,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/usuarios/eliminar/{id}", name="usuarios_eliminar")
     */

    public function eliminarUsuario(Request $request, UsuarioRepository $usuarioRepository,Usuario $usuario):Response
    {
        if ($request->get('confirmar', false)) {
            try {
                $usuarioRepository->delete($usuario);
                $this->addFlash('exito', 'Usuario eliminado con exito');
                return $this->redirectToRoute('usuarios_listar');
            } catch (\Exception $exception) {
                $this->addFlash('error', 'Error al eliminar el usuario');
            }
        }
        return $this->render('Usuario/eliminar.html.twig', [
            'usuario' => $usuario
        ]);
    }

    /**
     * @Route ("/usuarios", name="usuarios_listar")
     * @Security("is_granted('ROLE_USER')")
     */
    public function verEjercicios(UsuarioRepository $usuarioRepository):Response
    {
        $usuarioRepository=$usuarioRepository->verUsuarios();
        return  $this->render('Usuario/VerUsuarios.html.twig',['usuarios'=>$usuarioRepository]);
    }

    /**
     * @Route ("/usuarios/activado/{id}", name="usuarios_activar")
     */
    public function cambiaReservable(UsuarioRepository $usuarioRepository, Usuario $usuario):Response
    {
        $estado=$usuario->isActivado();
        if ($estado){
            $usuario->setActivado(false);
        }
        else{
            $usuario->setActivado(true);
        }
        $usuarioRepository->save();


        return $this->redirectToRoute("usuarios_listar");
    }

    /**
     * @Route("/usuarios/verMiTabla/{tabla}/{id}", name="usuarios_miTabla")
     *
     */
    public function verMiTabla(UsuarioRepository $usuarioRepository,string $tabla,string $id):Response
    {
        $tabla=$usuarioRepository->vermiTabla($tabla,$id);
        return $this->render('Usuario/verMiTabla.html.twig',['tabla'=>$tabla]);
    }

    /**
     * @Route ("/usuarios/asignar/{usuario}/{tabla}", name="usuarios_asignarTabla")
     */
    public function asignarTabla(UsuarioRepository $usuarioRepository, Usuario $usuario,Tabla $tabla):Response
    {
        $usuario->setMiTabla($tabla);
        $usuarioRepository->save();


        return $this->redirectToRoute("tablas_listar");
    }
}