<?php

namespace App\Service;

use App\Entity\Social;
use App\Repository\SocialRepository;
use Doctrine\ORM\EntityManagerInterface;

class SocialService
{
    private $manager;
    private $repository;

    public function __construct(EntityManagerInterface $manager, SocialRepository $repository)
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
     * @param  Social $social
     * @return void
     */
    public function persist(Social $social): void
    {
        $this->manager->persist($social);
        $this->manager->flush();
    }
    
    /**
     * @param  Social $social
     * @return void
     */
    public function delete(Social $social): void
    {
        $this->manager->remove($social);
        $this->manager->flush();
    }
}
