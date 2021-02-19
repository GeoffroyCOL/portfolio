<?php

namespace App\Controller\Front;

use App\Entity\Project;
use App\Service\SkillService;
use App\Service\SocialService;
use App\Service\ProjectService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    private $socialService;
    private $skillService;
    private $projectService;

    public function __construct(SocialService $socialService, SkillService $skillService, ProjectService $projectService)
    {
        $this->socialService = $socialService;
        $this->skillService = $skillService;
        $this->projectService = $projectService;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('front/home/index.html.twig', [
            'socials'   => $this->socialService->getAll(),
            'skills'    => $this->skillService->getAll(),
            'projects'  => $this->projectService->getProjectsByPagination(Project::NUMBER),
            'number'    => $this->projectService->getNumber() - Project::NUMBER
        ]);
    }
}
