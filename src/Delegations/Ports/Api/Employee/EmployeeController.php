<?php

declare(strict_types=1);

namespace App\Delegations\Ports\Api\Employee;

use App\Delegations\Employee\Application\Command\CreateEmployeeCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

final class EmployeeController extends AbstractController
{
    use HandleTrait;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    #[Route('/api/employee', methods: ['POST'])]
    public function post(): Response
    {
        $command = new CreateEmployeeCommand();
        $employeeId = $this->handle($command);

        return new JsonResponse(['id' => $employeeId], Response::HTTP_CREATED);
    }
}
