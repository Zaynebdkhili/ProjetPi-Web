<?php

namespace App\Controller;

use App\Entity\Echange;
use App\Form\EchangeType;
use App\Repository\EchangeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/echange')]
class EchangeController extends AbstractController
{
    #[Route('/', name: 'app_echange_index', methods: ['GET'])]
    public function index(EchangeRepository $echangeRepository): Response
    {
        return $this->render('echange/index.html.twig', [
            'echanges' => $echangeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_echange_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EchangeRepository $echangeRepository): Response
    {
        $echange = new Echange();
        $form = $this->createForm(EchangeType::class, $echange);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $echangeRepository->add($echange, true);

            return $this->redirectToRoute('app_echange_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('echange/new.html.twig', [
            'echange' => $echange,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_echange_show', methods: ['GET'])]
    public function show(Echange $echange): Response
    {
        return $this->render('echange/show.html.twig', [
            'echange' => $echange,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_echange_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Echange $echange, EchangeRepository $echangeRepository): Response
    {
        $form = $this->createForm(EchangeType::class, $echange);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $echangeRepository->add($echange, true);

            return $this->redirectToRoute('app_echange_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('echange/edit.html.twig', [
            'echange' => $echange,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_echange_delete', methods: ['POST'])]
    public function delete(Request $request, Echange $echange, EchangeRepository $echangeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$echange->getId(), $request->request->get('_token'))) {
            $echangeRepository->remove($echange, true);
        }

        return $this->redirectToRoute('app_echange_index', [], Response::HTTP_SEE_OTHER);
    }
}
