<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\State\ProcessorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserStateProcessor implements ProcessorInterface
{
    private $passwordHasher;
    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
        
    }
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): void
    {
        if ($operation instanceof Post){
        
            $data->setPassword($this->passwordHasher->hashPassword($data, $data->getPassword()));

            $this->entityManager->persist($data);
            $this->entityManager->flush();

        }
        if($operation instanceof Patch){
            
            $data->setPassword($this->passwordHasher->hashPassword($data, $data->getPassword()));

            $this->entityManager->persist($data);
            $this->entityManager->flush();
        }
        
    }
}
