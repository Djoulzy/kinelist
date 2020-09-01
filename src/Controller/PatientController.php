<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Form\PatientType;
use App\Repository\PatientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\BSMenuGenerator;

/**
 * @Route("/patient")
 */
class PatientController extends AbstractController
{
    protected $menu;

    public function __construct(BSMenuGenerator $menu)
    {
        $this->menu = $menu;
    }

    /**
     * @Route("/", name="patient_index", methods={"GET"})
     */
    public function index(BSMenuGenerator $menu, PatientRepository $patientRepository): Response
    {
        $options = array(
            'controller_name' => 'PatientController',
            'topmenu' => $this->menu->renderTopMenu('topmenu.ini'),
            'sidemenu' => $this->menu->renderSideMenu('patient.ini'),
            'patients' => $patientRepository->findAll()
        );
    
        return $this->render('patient/index.html.twig', $options);
    }

    /**
     * @Route("/new", name="patient_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $patient = new Patient();
        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($patient);
            $entityManager->flush();

            return $this->redirectToRoute('patient_index');
        }

        $options = array(
            'controller_name' => 'PatientController',
            'topmenu' => $this->menu->renderTopMenu('topmenu.ini'),
            'sidemenu' => $this->menu->renderSideMenu('patient.ini'),
            'patient' => $patient,
            'form' => $form->createView()
        );

        return $this->render('patient/new.html.twig', $options);
    }

    /**
     * @Route("/{id}", name="patient_show", methods={"GET"})
     */
    public function show(Patient $patient): Response
    {
        return $this->render('patient/show.html.twig', [
            'controller_name' => 'PatientController',
            'topmenu' => $this->menu->renderTopMenu('topmenu.ini'),
            'sidemenu' => $this->menu->renderSideMenu('patient.ini'),
            'patient' => $patient,
        ]);
    }

    /**
     * @Route("/{id}/infos", name="patient_infos", methods={"GET"})
     */
    public function infos(Patient $patient): Response
    {
        return $this->render('patient/infos.html.twig', [
            'controller_name' => 'PatientController',
            'patient' => $patient,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="patient_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Patient $patient): Response
    {
        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('patient_index');
        }

        return $this->render('patient/edit.html.twig', [
            'patient' => $patient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="patient_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Patient $patient): Response
    {
        if ($this->isCsrfTokenValid('delete'.$patient->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($patient);
            $entityManager->flush();
        }

        return $this->redirectToRoute('patient_index');
    }
}
