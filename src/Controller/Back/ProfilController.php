<?php

namespace App\Controller\Back;

use App\Form\UserEditType;
use App\Service\UserService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * ProfilController
 *
 * @Security("is_granted('ROLE_SUPER_ADMIN')", statusCode=403, message="vous ne pouvez pas accéder à cette partie !")
 */
class ProfilController extends AbstractController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * editProfil
     * 
     * @Route("/admin/edit/profil", name="edit.profil")
     * 
     * @param  Request $request
     * @return Response
     */
    public function editProfil(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserEditType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->userService->edit($form->getData());
            $this->addFlash('success', 'Votre profil à bien été modifié.');
            return $this->redirectToRoute('dashboard');
        }

        return $this->render('back/profil/edit.html.twig', [
            'form'  => $form->createView()
        ]);
    }
}
