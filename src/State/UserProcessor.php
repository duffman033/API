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

    public function __construct(
        private ProcessorInterface $persistProcessor,
        private ProcessorInterface $removeProcessor,
        private Security $security,
        private ManagerRegistry $doctrine
    ) {
    }

    public function process($data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        if ($operation instanceof DeleteOperationInterface) {
            return $this->removeProcessor->process($data, $operation, $uriVariables, $context);
        }

        $user = $this->security->getUser()->getId();
        $owner = $this->doctrine->getRepository(Client::class)->find($user);
        $data->setClient($owner);

        return $this->persistProcessor->process($data, $operation, $uriVariables, $context);
    }

}
