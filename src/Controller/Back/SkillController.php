<?php

namespace App\Controller\Back;

use App\Service\SkillService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SkillController extends AbstractController
{
    private $skillService;

    public function __construct(SkillService $skillService)
    {
        $this->skillService = $skillService;
    }

    /**
     * @Route("/admin/skills", name="list.skill")
     */
    public function listSkills(): Response
    {
        return $this->render('back/skill/listSkills.html.twig', [
            'skills' => $this->skillService->getAll()
        ]);
    }
}
