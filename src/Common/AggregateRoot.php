<?php

declare(strict_types=1);

namespace App\Common;

abstract class AggregateRoot
{
    /**
     * @var DomainEventInterface[]
     */
    private array $events = [];

    /**
     * @return DomainEventInterface[]
     */
    public function popEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }

    protected function raise(DomainEventInterface $event): void
    {
        $this->events[] = $event;
    }
}
