<?php

namespace App\Controller;

use App\Entity\Pointage;
use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use App\Form\PointageType;
use App\Repository\PointageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Debug\Debug;

/**
 * @Route("/pointage")
 */
class PointageController extends AbstractController
{
    /**
     * @Route("/", name="pointage_index", methods={"GET"})
     */
    public function index(PointageRepository $pointageRepository): Response
    {
        return $this->render('pointage/index.html.twig', [
            'pointages' => $pointageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="pointage_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pointage = new Pointage();
        $form = $this->createForm(PointageType::class, $pointage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pointage);
            $entityManager->flush();

            return $this->redirectToRoute('pointage_index');
        }

        return $this->render('pointage/new.html.twig', [
            'pointage' => $pointage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pointage_show", methods={"GET"}, requirements={"id":"\d+"})
     */
    public function show(Pointage $pointage, UtilisateurRepository $UtilisateurRepository): Response
    {
       $id = $pointage->getMatriculeUtilisateur();
       $Utilisateur = $UtilisateurRepository->findOneById($id);
        return $this->render('pointage/show.html.twig', [
            'pointage' => $pointage,
            'utilisateur' => $Utilisateur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pointage_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pointage $pointage): Response
    {
        $form = $this->createForm(PointageType::class, $pointage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pointage_index');
        }

        return $this->render('pointage/edit.html.twig', [
            'pointage' => $pointage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pointage_delete", methods={"POST"})
     */
    public function delete(Request $request, Pointage $pointage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pointage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pointage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pointage_index');
    }
}
