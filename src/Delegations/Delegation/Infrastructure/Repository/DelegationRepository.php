<?php

declare(strict_types=1);

namespace App\Delegations\Delegation\Infrastructure\Repository;

use App\Delegations\Delegation\Domain\Entity\Delegation;
use App\Delegations\Delegation\Domain\Repository\DelegationRepositoryInterface;
use App\Delegations\Employee\Domain\Entity\Employee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class DelegationRepository extends ServiceEntityRepository implements DelegationRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Delegation::class);
    }

    public function save(Delegation $delegation): void
    {
        $this->_em->persist($delegation);
        $this->_em->flush();
    }

    public function findForEmployee(Employee $employee): array
    {
        $delegations = $this->findBy(['employee' => $employee->id]);

        return $delegations;
    }
}
