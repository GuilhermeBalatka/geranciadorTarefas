<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Tarefas;
use App\Entity\Anexo;
use App\Form\AnexoType;
use App\Repository\AnexoRepository;
use Doctrine\ORM\EntityManagerInterface; // Importe o EntityManagerInterface
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\Mime\MimeTypes;
use Symfony\Component\HttpFoundation\HeaderUtils;

/**
 * @Route("/anexo")
 */
class AnexoController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

     /**
     * @Route("/{tarefaId}", name="app_anexo_index", methods={"GET"}, requirements={"tarefaId"="\d+"})
     */
    public function index(AnexoRepository $anexoRepository, int $tarefaId): Response
    {
        $anexos = $anexoRepository->findBy(['tarefa' => $tarefaId]);

        return $this->render('anexo/index.html.twig', [
            'anexos' => $anexos,
            'tarefaId' => $tarefaId,
        ]);
    }

    /**
     * @Route("/new/{tarefaId}", name="app_anexo_new", methods={"GET", "POST"})
     */
    public function new(Request $request, int $tarefaId): Response
    {
        $anexo = new Anexo();
        $form = $this->createForm(AnexoType::class, $anexo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Obtenha o arquivo de anexo do formulário
            $file = $form->get('arquivo')->getData();

            // Gere um nome de arquivo único
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Mova o arquivo para o diretório onde deseja armazenar os anexos
            $file->move(
                $this->getParameter('anexos_directory'), // Diretório configurado no seu projeto Symfony
                $fileName
            );

            // Defina o nome do arquivo no objeto Anexo
            $anexo->setArquivo($fileName);

            // Obtenha a entidade Tarefa
            $tarefa = $this->entityManager->getRepository(Tarefas::class)->find($tarefaId);
            $anexo->setTarefa($tarefa);

            // Persista o objeto Anexo no banco de dados
            $this->entityManager->persist($anexo);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_anexo_index', ['tarefaId' => $tarefaId]);
        }

        return $this->render('anexo/new.html.twig', [
            'anexo' => $anexo,
            'form' => $form->createView(),
            'tarefaId' => $tarefaId,
        ]);
    }

    /**
     * @Route("/{id}", name="app_anexo_show", methods={"GET"})
     */
    public function show(AnexoRepository $anexoRepository, int $id): Response
    {
        $anexo = $anexoRepository->find($id);

        if (!$anexo) {
            throw $this->createNotFoundException('Anexo não encontrado');
        }

        $anexoPath = $anexo->getArquivo();

        if (!file_exists($anexoPath)) {
            throw $this->createNotFoundException('Arquivo de anexo não encontrado no sistema de arquivos');
        }

        $mimeTypeGuesser = MimeTypes::getDefault();
        $mimeType = $mimeTypeGuesser->guessMimeType($anexoPath);

        if ($mimeType === 'application/octet-stream') {
            $mimeType = 'application/pdf';
        }

        $disposition = HeaderUtils::makeDisposition(
            HeaderUtils::DISPOSITION_INLINE,
            $anexo->getNome()
        );

        $response = new BinaryFileResponse($anexoPath);
        $response->headers->set('Content-Type', $mimeType);
        $response->headers->set('Content-Disposition', $disposition);

        return $response;
    }

    /**
     * @Route("/{id}/delete", name="app_anexo_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Anexo $anexo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$anexo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->entityManager; // Use o EntityManager injetado
            $entityManager->remove($anexo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_anexo_index', ['tarefaId' => $anexo->getTarefa()->getId()]);
    }
}
