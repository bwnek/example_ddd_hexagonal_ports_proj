<?php

declare(strict_types=1);

namespace App\Delegations\Employee\Domain\Repository;

use App\Delegations\Employee\Domain\Entity\Employee;

interface EmployeeRepositoryInterface
{
    public function find($id, $lockMode = null, $lockVersion = null);

    public function findAll();

    public function save(Employee $employee): void;
}
