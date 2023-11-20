<?php

declare(strict_types=1);

namespace App\Delegations\Employee\Domain\Entity;

use App\Common\AggregateRoot;

class Employee extends AggregateRoot
{
    public int $id;
}
