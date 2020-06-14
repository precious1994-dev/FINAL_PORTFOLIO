<?php

namespace App\Controller;

use App\Entity\Competence;
use App\Entity\Personne;
use App\Form\CompetenceType;
use App\Repository\CompetenceRepository;
use App\Repository\RealisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/competence")
 */
class CompetenceController extends AbstractController
{
    /**
     * @Route("/", name="competence_index", methods={"GET"})
     */
    public function index(CompetenceRepository $competenceRepository): Response
    {
        return $this->render('competence/index.html.twig', [
            'competences' => $competenceRepository->findAll(),
        ]);

    }
    /**
     * @Route("/list", name="competence_list", methods={"GET"})
     * @return Response
     */
    public function list(CompetenceRepository $competenceRepository): Response
    {
        //$realisationRepository = new  RealisationRepository();
        return $this->render('default/list_competences.html.twig', [
            'competences' => $competenceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="competence_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $competence = new Competence();
        $form = $this->createForm(CompetenceType::class, $competence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            //start a modifier
            //On doit fetch le current userconnected id
            $userconnectedId = 1;
            $entityManager   = $this->getDoctrine()->getManager();
            $user = $this->getDoctrine()
                ->getRepository(Personne::class)
                ->find($userconnectedId);
            $competence->setIdPersonne($user);
            //end a modifier
            $entityManager->persist($competence);
            $entityManager->flush();

            return $this->redirectToRoute('competence_index');
        }

        return $this->render('competence/new.html.twig', [
            'competence' => $competence,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="competence_show", methods={"GET"})
     */
    public function show(Competence $competence): Response
    {
        return $this->render('competence/show.html.twig', [
            'competence' => $competence,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="competence_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Competence $competence): Response
    {
        $form = $this->createForm(CompetenceType::class, $competence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('competence_index');
        }

        return $this->render('competence/edit.html.twig', [
            'competence' => $competence,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="competence_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Competence $competence): Response
    {
        if ($this->isCsrfTokenValid('delete'.$competence->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($competence);
            $entityManager->flush();
        }

        return $this->redirectToRoute('competence_index');
    }
}
