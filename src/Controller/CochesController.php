<?php

namespace App\Controller;

use App\Entity\Coches;
use App\Form\CochesType;
use App\Repository\CochesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/coches')]
class CochesController extends AbstractController
{
    #[Route('/', name: 'app_coches_index', methods: ['GET'])]
    public function index(CochesRepository $cochesRepository): Response
    {
        return $this->render('coches/index.html.twig', [
            'coches' => $cochesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_coches_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CochesRepository $cochesRepository): Response
    {
        $coch = new Coches();
        $form = $this->createForm(CochesType::class, $coch);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cochesRepository->save($coch, true);

            return $this->redirectToRoute('app_coches_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('coches/new.html.twig', [
            'coch' => $coch,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_coches_show', methods: ['GET'])]
    public function show(Coches $coch): Response
    {
        return $this->render('coches/show.html.twig', [
            'coch' => $coch,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_coches_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Coches $coch, CochesRepository $cochesRepository): Response
    {
        $form = $this->createForm(CochesType::class, $coch);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cochesRepository->save($coch, true);

            return $this->redirectToRoute('app_coches_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('coches/edit.html.twig', [
            'coch' => $coch,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_coches_delete', methods: ['POST'])]
    public function delete(Request $request, Coches $coch, CochesRepository $cochesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$coch->getId(), $request->request->get('_token'))) {
            $cochesRepository->remove($coch, true);
        }

        return $this->redirectToRoute('app_coches_index', [], Response::HTTP_SEE_OTHER);
    }
}
