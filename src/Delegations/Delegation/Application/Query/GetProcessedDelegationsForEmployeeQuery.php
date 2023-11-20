<?php

declare(strict_types=1);

namespace App\Delegations\Delegation\Application\Query;

use App\Delegations\Employee\Domain\Entity\Employee;
final class GetProcessedDelegationsForEmployeeQuery
{
    public function __construct(public int $employeeId)
    {
    }
}
