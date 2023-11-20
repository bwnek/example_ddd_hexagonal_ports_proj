<?php

declare(strict_types=1);

namespace App\Delegations\Employee\Application\Command;

use App\Delegations\Employee\Domain\Entity\Employee;
use App\Delegations\Employee\Domain\Repository\EmployeeRepositoryInterface;

final class CreateEmployeeCommandHandler
{
    public function __construct(
        private EmployeeRepositoryInterface $employeeRepository,
    )
    {
    }

    public function __invoke(CreateEmployeeCommand $command): int
    {
        $employee = new Employee();

        $this->employeeRepository->save($employee);

        return $employee->id;
    }
}

