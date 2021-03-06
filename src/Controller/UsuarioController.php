<?php

namespace App\Controller;

use App\Entity\Tabla;
use App\Entity\Usuario;
use App\Form\CambioContraType;
use App\Form\PerfilType;
use App\Form\UsuarioType;
use App\Repository\UsuarioRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class UsuarioController extends AbstractController
{

    /**
     * @Route ("/usuarios/nuevo", name="usuarios_nuevo")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function nuevoUsuario(Request $request, UsuarioRepository $usuarioRepository, SluggerInterface $slugger): Response
    {
        $usuario = $usuarioRepository->nuevo();
        $usuario->setContrasenia('gymbros');
        return $this->modificarUsuario($request,$usuarioRepository,$usuario,$slugger);
    }

    /**
     * @Route ("/usuarios/modificar/{id}", name="usuarios_modificar")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function modificarUsuario(Request $request,UsuarioRepository $usuarioRepository, Usuario $usuario, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                /**
                 * @var UploadedFile $brochureFile
                 */
                $brochureFile = $form->get('brochure')->getData();

                // this condition is needed because the 'brochure' field is not required
                // so the PDF file must be processed only when a file is uploaded
                if ($brochureFile) {
                    $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                    // Move the file to the directory where brochures are stored
                    try {
                        $brochureFile->move(
                            $this->getParameter('brochures_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }

                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents
                    $usuario->setBrochureFilename($newFilename);
                }
                $usuarioRepository->save();
                $this->addFlash('exito', 'Cambios guardados con ??xito');
                return $this->redirectToRoute('usuarios_listar');
            } catch (\Exception $exception) {
                $this->addFlash('error', $exception);
            }
        }
        return $this->render('Usuario/modificar.html.twig', [
            'usuario' => $usuario,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/usuarios/perfil/{id}", name="usuarios_perfil")
     * @Security("is_granted('ROLE_USER')")
     */
    public function modificarPerfil(Request $request,UsuarioRepository $usuarioRepository, Usuario $usuario, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(PerfilType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                /**
                 * @var UploadedFile $brochureFile
                 */
                $brochureFile = $form->get('brochure')->getData();

                // this condition is needed because the 'brochure' field is not required
                // so the PDF file must be processed only when a file is uploaded
                if ($brochureFile) {
                    $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                    // Move the file to the directory where brochures are stored
                    try {
                        $brochureFile->move(
                            $this->getParameter('brochures_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }

                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents
                    $usuario->setBrochureFilename($newFilename);
                }
                $usuarioRepository->save();
                $this->addFlash('exito', 'Cambios guardados con ??xito');
                return $this->redirectToRoute('principal');
            } catch (\Exception $exception) {
                $this->addFlash('error', $exception);
            }
        }
        return $this->render('Usuario/perfil.html.twig', [
            'usuario' => $usuario,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/usuarios/eliminar/{id}", name="usuarios_eliminar")
     * @Security("is_granted('ROLE_ADMIN')")
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
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function verUsuarios(UsuarioRepository $usuarioRepository):Response
    {
        $usuarioRepository=$usuarioRepository->verUsuarios();
        return  $this->render('Usuario/VerUsuarios.html.twig',['usuarios'=>$usuarioRepository]);
    }

    /**
     * @Route ("/usuarios/activado/{id}", name="usuarios_activar")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function activarUsuario(UsuarioRepository $usuarioRepository, Usuario $usuario):Response
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
     * @Security("is_granted('ROLE_USER')")
     */
    public function verMiTabla(UsuarioRepository $usuarioRepository,string $tabla,string $id):Response
    {
        $tabla=$usuarioRepository->vermiTabla($tabla,$id);
        return $this->render('Usuario/verMiTabla.html.twig',['tabla'=>$tabla]);
    }

    /**
     * @Route ("/usuarios/asignar/{usuario}/{tabla}", name="usuarios_asignarTabla")
     * @Security("is_granted('ROLE_USER')")
     */
    public function asignarTabla(UsuarioRepository $usuarioRepository, Usuario $usuario,Tabla $tabla):Response
    {
        $usuario->setMiTabla($tabla);
        $usuarioRepository->save();

        if($usuario->isEsMonitor()==true)
            return $this->redirectToRoute('tablas_listar');
        else
            return $this->redirectToRoute('tablas_listarUser',['usuario'=>$usuario->getId()]);
    }

    /**
     * @Route("/usuario/cambioContra", name="usuarios_cambioContra")
     * @Security("is_granted('ROLE_USER')")
     */
    public function cambiarContra(Request $request, UsuarioRepository $usuarioRepository, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $form = $this->createForm(CambioContraType::class, $this->getUser());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->getUser()->setContrasenia(
                    $passwordEncoder->encodePassword(
                        $this->getUser(), $form->get('contraNueva')->get('first')->getData()
                    )
                );

                $usuarioRepository->save();

                return $this->redirectToRoute('principal');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Error al guardar los cambios');
            }
        }

        return $this->render('Usuario/cambioContra.html.twig', [
            'usuario' => $this->getUser(),
            'form' => $form->createView()
        ]);
    }
}