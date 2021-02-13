<?php

namespace App\Controller\Back;

use App\Form\SocialType;
use App\Service\SocialService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SocialController extends AbstractController
{
    private $socialService;

    public function __construct(SocialService $socialService)
    {
        $this->socialService = $socialService;
    }

    /**
     * addSocial
     *
     * @Route("/admin/add/social", name="add.social")
     * 
     * @param  Request $request
     * @return Response
     */
    public function addSocial(Request $request): Response
    {
        $form = $this->createForm(SocialType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->socialService->persist($form->getData());
            $this->addFlash('success', 'Le réseau social à bien été modifié.');
            return $this->redirectToRoute('dashboard');
        }

        return $this->render('back/social/gestionSocial.html.twig', [
            'form'      => $form->createView(),
            'action'    => 'Ajouter'
        ]);
    }
}
