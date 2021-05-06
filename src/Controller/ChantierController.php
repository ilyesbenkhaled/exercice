<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Entity\Pointage;
use App\Entity\Chantier;
use App\Form\ChantierType;
use App\Repository\ChantierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/chantier")
 */
class ChantierController extends AbstractController
{

  /**
   * @Route("/list", name="list", methods={"GET"})
   */
  public function list(): Response
  {
    $entityManager = $this->getDoctrine()->getManager();
    $chantier = $entityManager->getRepository(Chantier::class)->findAll();
    $pointage = $entityManager->getRepository(Pointage::class)->findAll();
      return $this->render('chantier/listes.html.twig', [
          'chantier' => $chantier,
          'pointage' => $pointage,
      ]);
  }

    /**
     * @Route("/", name="chantier_index", methods={"GET"})
     */
    public function index(ChantierRepository $chantierRepository): Response
    {
        return $this->render('chantier/index.html.twig', [
            'chantiers' => $chantierRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="chantier_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $chantier = new Chantier();
        $form = $this->createForm(ChantierType::class, $chantier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($chantier);
            $entityManager->flush();

            return $this->redirectToRoute('chantier_index');
        }

        return $this->render('chantier/new.html.twig', [
            'chantier' => $chantier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="chantier_show", methods={"GET"})
     */
    public function show(Chantier $chantier): Response
    {
        return $this->render('chantier/show.html.twig', [
            'chantier' => $chantier,
        ]);
    }


    /**
     * @Route("/{id}/edit", name="chantier_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Chantier $chantier): Response
    {
        $form = $this->createForm(ChantierType::class, $chantier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('chantier_index');
        }

        return $this->render('chantier/edit.html.twig', [
            'chantier' => $chantier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="chantier_delete", methods={"POST"})
     */
    public function delete(Request $request, Chantier $chantier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chantier->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($chantier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('chantier_index');
    }

}
