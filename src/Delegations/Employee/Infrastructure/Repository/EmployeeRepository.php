<?php

declare(strict_types=1);

namespace App\Delegations\Employee\Infrastructure\Repository;

use App\Delegations\Employee\Domain\Entity\Employee;
use App\Delegations\Employee\Domain\Repository\EmployeeRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class EmployeeRepository extends ServiceEntityRepository implements EmployeeRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Employee::class);
    }

    public function save(Employee $employee): void
    {
        $this->_em->persist($employee);
        $this->_em->flush();
    }
}
