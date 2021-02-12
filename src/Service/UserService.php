<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService
{
    private $manager;
    private $repository;
    private $passwordEncoder;

    public function __construct(EntityManagerInterface $manager, UserRepository $repository, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->manager = $manager;
        $this->repository = $repository;
        $this->passwordEncoder = $passwordEncoder;
    }
    
    /**
     * edit
     *
     * @param  User $user
     * @return void
     */
    public function edit(User $user): void
    {
        if ($user->getNewPassword()) {
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                $user->getNewpassword()
            ));
        }

        $this->manager->flush();
    }
}
