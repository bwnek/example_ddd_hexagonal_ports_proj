<?php

declare(strict_types=1);

namespace App\Delegations\Delegation\Domain\Repository;

use App\Delegations\Delegation\Domain\Entity\Delegation;
use App\Delegations\Employee\Domain\Entity\Employee;

interface DelegationRepositoryInterface
{
    public function save(Delegation $delegation): void;

    public function findForEmployee(Employee $employee): array;
}
