<?php

namespace App\Controller\Back;

use App\Service\SocialService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Security("is_granted('ROLE_SUPER_ADMIN')", statusCode=403, message="vous ne pouvez pas accéder à cette partie !")
 */
class DashboardController extends AbstractController
{
    private $socialService;

    public function __construct(SocialService $socialService)
    {
        $this->socialService = $socialService;
    }

    /**
     * @Route("/dashboard", name="dashboard")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('back/dashboard/index.html.twig', [
            'socials'   => $this->socialService->getAll()
        ]);
    }
}
