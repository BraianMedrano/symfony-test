<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Form\UsuarioType;
use App\Repository\UsuarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Materias;

#[Route('/usuario')]
class UsuarioController extends AbstractController
{
    #[Route('/', name: 'app_usuario_index', methods: ['GET'])]

    // Si luego queremos usar otras entidades (repositories) en el controlador debemos pasarle el entityManager como parametro a la funcion index() y luego usarlo para obtener el repositorio de la entidad que queremos usar
    public function index(UsuarioRepository $usuarioRepository, EntityManagerInterface $entityManager): Response
    {
        // Lo que hace la funcion dump es imprimir en pantalla el contenido de la variable en caso de que quieramos hacer un debug

        // dump($usuarioRepository->findAll());

        // Suponiendo que queremos filtrar los usuarios que tengan el nombre de "Juan" utilizamos la siguiente linea usando el findBy()
        // $usuarios = $usuarioRepository->findBy(['nombre' => 'braian']);

        // Podemos hacer que se ordene de manera ascendente o descendente pasandole un array en el 2do parametro del findBy() de la siguiente manera:
        // $usuarios = $usuarioRepository->findBy([], ['id' => 'ASC']);
        // $usuarios = $usuarioRepository->findBy([], ['id' => 'DESC']);

        // Tambien se puede utilizar de la siguiente manera pasandole un array asociativo con el nombre del campo y el valor que queremos filtrar
        // $usuarios = $usuarioRepository->findBy(array('nombre' => 'Juan');

        // Otra manera es usar el metodo que nos permite hacer consultas mas complejas y que creamos en el archivo UsuarioRepository.php
        // $usuarios = $usuarioRepository->findByName('Ramiro');

        // Tambien lo mismo que arriba solo que con una query de sql tambien creada en el archivo UsuarioRepository.php (aca se lo puede aplicar sin necesidad de usar el entity manager y get repository como en el video 14 de youtube)
        // $usuarios = $usuarioRepository->findByNameSql('Ramiro');


        // Ahora si queremos traer todas las materias que existen en la base de datos debemos usar en entityManager y el getRepository() de la siguiente manera
        $materias = $entityManager->getRepository(Materias::class)->findAll();
        dump($materias);

        $usuarios = $usuarioRepository->findAll();

        return $this->render('usuario/index.html.twig', [
            'usuarios' => $usuarios,
        ]);
    }

    #[Route('/new', name: 'app_usuario_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $usuario = new Usuario();
        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($usuario);
            $entityManager->flush();

            return $this->redirectToRoute('app_usuario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('usuario/new.html.twig', [
            'usuario' => $usuario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_usuario_show', methods: ['GET'])]
    public function show(Usuario $usuario): Response
    {
        return $this->render('usuario/show.html.twig', [
            'usuario' => $usuario,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_usuario_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Usuario $usuario, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_usuario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('usuario/edit.html.twig', [
            'usuario' => $usuario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_usuario_delete', methods: ['POST'])]
    public function delete(Request $request, Usuario $usuario, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$usuario->getId(), $request->request->get('_token'))) {
            $entityManager->remove($usuario);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_usuario_index', [], Response::HTTP_SEE_OTHER);
    }
}
