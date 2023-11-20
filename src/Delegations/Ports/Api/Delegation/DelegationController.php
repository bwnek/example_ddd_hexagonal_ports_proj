<?php

declare(strict_types=1);

namespace App\Delegations\Ports\Api\Delegation;

use App\Delegations\Delegation\Application\Command\CreateDelegationCommand;
use App\Delegations\Delegation\Application\Query\GetProcessedDelegationsForEmployeeQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

final class DelegationController extends AbstractController
{
    use HandleTrait;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    #[Route('/api/delegation', methods: ['POST'])]
    public function post(Request $request): Response
    {
        $parameters = \json_decode($request->getContent(),true, 512, JSON_THROW_ON_ERROR);

        $command = new CreateDelegationCommand(
            \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $parameters['start']),
            \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $parameters['end']),
            $parameters['employee_id'],
            $parameters['country']
        );

        $delegation = $this->handle($command);

        return new JsonResponse(['id' => $delegation], Response::HTTP_CREATED);
    }

    #[Route('/api/delegation', name: 'employee', methods: ['GET'])]
    public function get(Request $request): Response
    {
        $employeeId = (int)$request->get('employee_id');

        $query = new GetProcessedDelegationsForEmployeeQuery($employeeId);

        $delegations = $this->handle($query);

        return new JsonResponse($delegations);
    }
}
