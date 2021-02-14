<?php

namespace App\Controller\Back;

use App\Entity\Social;
use App\Form\SocialType;
use App\Service\SocialService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Security("is_granted('ROLE_SUPER_ADMIN')", statusCode=403, message="vous ne pouvez pas accéder à cette partie !")
 */
class SocialController extends AbstractController
{
    private $socialService;

    public function __construct(SocialService $socialService)
    {
        $this->socialService = $socialService;
    }

    /**
     * @Route("/admin/add/social", name="add.social")
     * @param  Request $request
     * @return Response
     */
    public function addSocial(Request $request): Response
    {
        $form = $this->createForm(SocialType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->socialService->persist($form->getData());
            $this->addFlash('success', 'Le réseau social à bien été ajouté.');
            return $this->redirectToRoute('dashboard');
        }

        return $this->render('back/social/gestionSocial.html.twig', [
            'form'      => $form->createView(),
            'action'    => 'Ajouter'
        ]);
    }

    /**
     * @Route("/admin/edit/social/{id}", name="edit.social")
     * @param  Social $social
     * @param  Request $request
     * @return Response
     */
    public function editSocial(Request $request, Social $social): Response
    {
        $form = $this->createForm(SocialType::class, $social);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->socialService->persist($form->getData());
            $this->addFlash('success', 'Le réseau social à bien été modifié.');
            return $this->redirectToRoute('dashboard');
        }

        return $this->render('back/social/gestionSocial.html.twig', [
            'form'      => $form->createView(),
            'action'    => 'Modifier'
        ]);
    }

    /**
     * @Route("/admin/delete/social/{id}", name="delete.social")
     * @param  Social $social
     * @return Response
     */
    public function deleteSocial(Social $social): Response
    {
        $this->socialService->delete($social);
        $this->addFlash('success', 'Le réseau social à bien été supprimé.');
        return $this->redirectToRoute('dashboard');
    }
}
