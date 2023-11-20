<?php

declare(strict_types=1);

namespace App\Delegations\Delegation\Application\Query;

use App\Delegations\Delegation\Domain\Entity\Delegation;
use App\Delegations\Delegation\Domain\Repository\DelegationRepositoryInterface;
use App\Delegations\Employee\Domain\Repository\EmployeeRepositoryInterface;

final class GetProcessedDelegationsForEmployeeQueryHandler
{
    private array $allowance = [
        'pl' => 10,
        'de' => 50,
        'gb' => 75
    ];

    public function __construct(
        private DelegationRepositoryInterface $delegationRepository,
        private EmployeeRepositoryInterface $employeeRepository
    )
    {
    }

    public function __invoke(GetProcessedDelegationsForEmployeeQuery $query)
    {
        $employee = $this->employeeRepository->find($query->employeeId);
        $currentDelegations = $this->delegationRepository->findForEmployee($employee);



        foreach ($currentDelegations as $delegation) {
            /** @var Delegation $delegation */
            $now = new \DateTimeImmutable();

            // check if more than 8h, if no then no allowance
            // check if weekend, if yes then no allowance
            // check if more than 7 days, then allowance x2
        }
    }
}
