<?php

declare(strict_types=1);

namespace App\Delegations\Delegation\Application\Command;

final class CreateDelegationCommand
{
    public function __construct(
        public \DateTimeInterface $periodStart,
        public \DateTimeInterface $periodEnd,
        public int $employeeId,
        public string $country
    )
    {
    }
}
