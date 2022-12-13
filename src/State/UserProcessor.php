<?php

namespace App\State;

use ApiPlatform\Metadata\DeleteOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Client;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;

class UserProcessor implements ProcessorInterface
{
    private $security;
    private $doctrine;

    public function __construct(private ProcessorInterface $persistProcessor, private ProcessorInterface $removeProcessor, Security $security, ManagerRegistry $doctrine)
    {
        $this->security = $security;
        $this->doctrine = $doctrine;
    }

    public function process($data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        if ($operation instanceof DeleteOperationInterface) {
            return $this->removeProcessor->process($data, $operation, $uriVariables, $context);
        }

        $user = $this->security->getUser()->getId();
        $owner = $this->doctrine->getRepository(Client::class)->find($user);
        $data->setClient($owner);

        $result = $this->persistProcessor->process($data, $operation, $uriVariables, $context);
        return $result;
    }

}
