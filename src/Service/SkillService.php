<?php

namespace App\Service;

use App\Entity\Skill;
use App\Repository\SkillRepository;
use Doctrine\ORM\EntityManagerInterface;

class SkillService
{
    private $manager;
    private $repository;

    public function __construct(EntityManagerInterface $manager, SkillRepository $repository)
    {
        $this->manager = $manager;
        $this->repository = $repository;
    }
    
    /**
     * @return array|null
     */
    public function getAll(): ?array
    {
        return $this->repository->findAll();
    }
    
    /**
     * @param  Skill $skill
     * @return void
     */
    public function persist(Skill $skill): void
    {
        $this->manager->persist($skill);
        $this->manager->flush();
    }
    
    /**
     * @param  Skill $skill
     * @return void
     */
    public function delete(Skill $skill): void
    {
        $this->manager->remove($skill);
        $this->manager->flush();
    }
}
