<?php

namespace App\Controller;

use App\Entity\Pathologie;
use App\Entity\Patient;
use App\Form\PathologieType;
use App\Repository\PathologieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pathologie")
 */
class PathologieController extends AbstractController
{
    /**
     * @Route("/{patient_id}", name="pathologie_index", methods={"GET"})
     */
    public function index(PathologieRepository $pathologieRepository, int $patient_id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $patient = $entityManager->getRepository(Patient::class)->find($patient_id);

        return $this->render('pathologie/index.html.twig', [
            'patient' => $patient,
            'pathologies' => $pathologieRepository->findBy(['patient' => $patient]), // , array $orderBy = null, $limit = null, $offset = null),
        ]);
    }

    /**
     * @Route("/new/{patient_id}", name="pathologie_new", methods={"GET","POST"})
     */
    public function new(Request $request, int $patient_id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $patient = $entityManager->getRepository(Patient::class)->find($patient_id);

        $pathologie = new Pathologie();
        $form = $this->createForm(PathologieType::class, $pathologie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pathologie->setPatient($patient);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pathologie);
            $entityManager->flush();

            return $this->redirectToRoute('pathologie_index', ['patient_id' => $patient_id]);
        }

        return $this->render('pathologie/new.html.twig', [
            'pathologie' => $pathologie,
            'patient' => $patient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{patient_id}/{id}", name="pathologie_show", methods={"GET"})
     */
    public function show(Pathologie $pathologie, int $patient_id, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $patient = $entityManager->getRepository(Patient::class)->find($patient_id);

        return $this->render('pathologie/show.html.twig', [
            'patient' => $patient,
            'pathologie' => $pathologie,
        ]);
    }

    /**
     * @Route("/{patient_id}/{id}/edit", name="pathologie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pathologie $pathologie, int $patient_id, int $id): Response
    {
        jlog($pathologie);
        $entityManager = $this->getDoctrine()->getManager();
        $patient = $entityManager->getRepository(Patient::class)->find($patient_id);

        $form = $this->createForm(PathologieType::class, $pathologie, [
            'action' => $this->generateUrl('pathologie_edit', ['patient_id' => $patient_id, 'id' => $id]),
            'method' => 'POST',
        ]);
        $form->handleRequest($request);
        // $form->getConfig()->getAction()

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pathologie_index', ['patient_id' => $patient_id]);
        }

        return $this->render('pathologie/edit.html.twig', [
            'patient' => $patient,
            'pathologie' => $pathologie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pathologie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Pathologie $pathologie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pathologie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pathologie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pathologie_index');
    }
}
