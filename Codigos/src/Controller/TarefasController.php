<?php

namespace App\Controller;

use App\Entity\Tarefas;
use App\Form\TarefasType;
use App\Repository\TarefasRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tarefas')]
class TarefasController extends AbstractController
{
    #[Route('/', name: 'app_tarefas_index', methods: ['GET'])]
    public function index(TarefasRepository $tarefasRepository): Response
    {
        return $this->render('tarefas/index.html.twig', [
            'tarefas' => $tarefasRepository->findAll(),
        ]);
    }

    #[Route('/nova_Tarefa', name: 'app_tarefas_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tarefa = new Tarefas();
        $form = $this->createForm(TarefasType::class, $tarefa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tarefa);
            $entityManager->flush();

            return $this->redirectToRoute('app_tarefas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tarefas/new.html.twig', [
            'tarefa' => $tarefa,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tarefas_show', methods: ['GET'])]
    public function show(Tarefas $tarefa): Response
    {
        return $this->render('tarefas/show.html.twig', [
            'tarefa' => $tarefa,
        ]);
    }

    #[Route('/{id}/editar', name: 'app_tarefas_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tarefas $tarefa, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TarefasType::class, $tarefa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            
            return $this->redirectToRoute('app_tarefas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tarefas/edit.html.twig', [
            'tarefa' => $tarefa,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tarefas_delete', methods: ['POST'])]
    public function delete(Request $request, Tarefas $tarefa, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tarefa->getId(), $request->request->get('_token'))) {
            $entityManager->remove($tarefa);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tarefas_index', [], Response::HTTP_SEE_OTHER);
    }
}
