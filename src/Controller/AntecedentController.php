<?php

namespace App\Controller;

use App\Entity\Antecedent;
use App\Form\AntecedentType;
use App\Repository\AntecedentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/antecedent")
 */
class AntecedentController extends AbstractController
{
    /**
     * @Route("/", name="antecedent_index", methods={"GET"})
     */
    public function index(AntecedentRepository $antecedentRepository): Response
    {
        return $this->render('antecedent/index.html.twig', [
            'antecedents' => $antecedentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="antecedent_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $antecedent = new Antecedent();
        $form = $this->createForm(AntecedentType::class, $antecedent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($antecedent);
            $entityManager->flush();

            return $this->redirectToRoute('antecedent_index');
        }

        return $this->render('antecedent/new.html.twig', [
            'antecedent' => $antecedent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="antecedent_show", methods={"GET"})
     */
    public function show(Antecedent $antecedent): Response
    {
        return $this->render('antecedent/show.html.twig', [
            'antecedent' => $antecedent,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="antecedent_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Antecedent $antecedent): Response
    {
        $form = $this->createForm(AntecedentType::class, $antecedent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('antecedent_index');
        }

        return $this->render('antecedent/edit.html.twig', [
            'antecedent' => $antecedent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="antecedent_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Antecedent $antecedent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$antecedent->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($antecedent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('antecedent_index');
    }
}
