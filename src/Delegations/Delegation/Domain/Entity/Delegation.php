<?php

declare(strict_types=1);

namespace App\Delegations\Delegation\Domain\Entity;

use App\Common\AggregateRoot;
use App\Delegations\Employee\Domain\Entity\Employee;

class Delegation extends AggregateRoot
{
    public int $id;

    public \DateTimeInterface $periodStart;

    public \DateTimeInterface $periodEnd;

    public Employee $employee;

    public string $country;
}
