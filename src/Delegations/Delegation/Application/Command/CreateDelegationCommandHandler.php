<?php

declare(strict_types=1);

namespace App\Delegations\Delegation\Application\Command;

use App\Delegations\Delegation\Domain\Entity\Delegation;
use App\Delegations\Delegation\Domain\Repository\DelegationRepositoryInterface;
use App\Delegations\Employee\Domain\Entity\Employee;
use App\Delegations\Employee\Domain\Repository\EmployeeRepositoryInterface;

final class CreateDelegationCommandHandler
{
    public function __construct(
        private DelegationRepositoryInterface $delegationRepository,
        private EmployeeRepositoryInterface $employeeRepository
    )
    {
    }

    public function __invoke(CreateDelegationCommand $command): int
    {
        $employee = $this->employeeRepository->find($command->employeeId);

        // check if given employee is valid
        if ($employee === null) {
            throw new \Exception('Employee not found.');
        }

        // check if employee is currently at the delegation
        if ($this->checkIfEmployeeHasActiveDelegation($employee)) {
            throw new \Exception('Could not add new delegation. User already on delegation.');
        }

        // check if delegation time period is valid
        // start of the delegation need to be earlier in time than end
        if ($command->periodStart > $command->periodEnd) {
            throw new \Exception('Invalid delegation dates.');
        }


        $delegation = new Delegation();
        $delegation->periodStart = $command->periodStart;
        $delegation->periodEnd = $command->periodEnd;
        $delegation->country = $command->country;
        $delegation->employee = $employee;

        $this->delegationRepository->save($delegation);

        return $delegation->id;
    }

    private function checkIfEmployeeHasActiveDelegation(Employee $employee): bool
    {
        $currentDelegations = $this->delegationRepository->findForEmployee($employee);

        foreach ($currentDelegations as $delegation) {
            /** @var Delegation $delegation */
            $now = new \DateTimeImmutable();

            if ($now >= $delegation->periodStart && $now <= $delegation->periodEnd) {
                return true;
            }
        }

        return false;
    }
}

