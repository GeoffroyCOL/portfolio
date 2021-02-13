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
     * getAll
     *
     * @return array|null
     */
    public function getAll(): ?array
    {
        return $this->repository->findAll();
    }
    
    /**
     * persist
     *
     * @param  Social $social
     * @return void
     */
    public function persist(Social $social): void
    {
        $this->manager->persist($social);
        $this->manager->flush();
    }
}