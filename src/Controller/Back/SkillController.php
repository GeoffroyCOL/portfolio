<?php

namespace App\Controller\Back;

use App\Entity\Skill;
use App\Form\SkillType;
use App\Service\SkillService;
use Symfony\Component\HttpFoundation\Request;
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
    
    /**
     * addSkill
     * 
     * @Route("/admin/add/skill", name="add.skill")
     *
     * @param  Request $request
     * @return Response
     */
    public function addSkill(Request $request): Response
    {
        $form = $this->createForm(SkillType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->skillService->persist($form->getData());
            $this->addFlash('success', 'La compétence à bien été ajoutée.');
            return $this->redirectToRoute('list.skill');
        }

        return $this->render('back/skill/gestionSkill.html.twig', [
            'form'      => $form->createView(),
            'pageTitle' => 'Ajouter une compétence'
        ]);
    }
    
    /**
     * editSkill
     *
     * @Route("/admin/edit/skill/{id}", name="edit.skill")
     * 
     * @param  Request $request
     * @param  Skill $skill
     * @return Response
     */
    public function editSkill(Request $request, Skill $skill): Response
    {
        $form = $this->createForm(SkillType::class, $skill);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->skillService->persist($form->getData());
            $this->addFlash('success', 'La compétence à bien été modifiée.');
            return $this->redirectToRoute('list.skill');
        }

        return $this->render('back/skill/gestionSkill.html.twig', [
            'form'      => $form->createView(),
            'pageTitle' => 'Modifier une compétence'
        ]);
    }
}
