<?php

namespace App\Action\User;

use App\Domain\User\Data\UserFinderResult;
use App\Domain\User\Service\UserFinder;
use App\Renderer\JsonRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UserFinderAction
{
    private UserFinder $userFinder;

    private JsonRenderer $renderer;

    public function __construct(UserFinder $userFinder, JsonRenderer $jsonRenderer)
    {
        $this->userFinder = $userFinder;
        $this->renderer = $jsonRenderer;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Optional: Pass parameters from the request to the service method
        // ...

        $users = $this->userFinder->findUsers();

        // Transform result and render to json
        return $this->renderer->json($response, $this->transform($users));
    }

    public function transform(UserFinderResult $result): array
    {
        $users = [];

        foreach ($result->users as $user) {
            $users[] = [
                'id' => $user->id,
                'number' => $user->number,
                'name' => $user->name,
                'street' => $user->street,
                'postal_code' => $user->postalCode,
                'city' => $user->city,
                'country' => $user->country,
                'email' => $user->email,
            ];
        }

        return [
            'users' => $users,
        ];
    }
}
