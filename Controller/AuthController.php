<?php

namespace Controller;

use Firebase\JWT\JWT;
use Request;
use Response;
use Exception;
use UserFactory;
use UserRoleFactory;

class AuthController extends BaseController
{

    /**
     * @var JWT
     */
    private $jwt;

    /**
     * @var UserFactory
     */
    private $userFactory;

    /**
     * @var UserRoleFactory
     */
    private $userRoleFactory;

    /**
     * AuthController constructor.
     *
     * @param JWT $jwt
     * @param UserFactory $userFactory
     * @param UserRoleFactory $userRoleFactory
     */
    public function __construct(
//        JWT $jwt,
//        UserFactory $userFactory,
//        UserRoleFactory $userRoleFactory
    )
    {
        $this->jwt = new JWT;
        $this->userFactory = new UserFactory;
        $this->userRoleFactory = new UserRoleFactory;
//        $this->jwt = $jwt;
//        $this->userFactory = $userFactory;
//        $this->userRoleFactory = $userRoleFactory;
    }

    /**
     * Register a new user
     */
    function register($request)
    {
        try {
            // check if username exists
            $usernameExists = UserFactory::getByUsername($request->username);
            if ($usernameExists) {
                throw new Exception("Username already exists");
            }

            // check if email exists
            $emailExists = UserFactory::getByEmail($request->email);
            if ($emailExists) {
                throw new Exception("Email already registered!");
            }

            // do password checks

            $user = $this->userFactory->create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => password_hash($request->password, PASSWORD_BCRYPT)
            ]);

            // Set user role
            if (isset($request->role)) {
                $role = $request->role;
            } else {
                $role = 1;
            }
            $this->userRoleFactory->setUserRole($role, $user->getId());

            return $this->sendOutput(
                json_encode(['message' => "User was registered successfully!"]),
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );

        } catch (\Exception $e) {
            return $this->sendOutput(
                json_encode(['error' => $e->getMessage()]),
                array('Content-Type: application/json', 'HTTP/1.1 500 Internal Server Error')
            );
        }

    }

    function signin($request)
    {
        try {
            $user = UserFactory::getByUsername($request->username);

            if (!$user) {
                throw new Exception("User not found!");
            }

            if (!password_verify($request->password, $user->getPassword())) {
                throw new Exception("Password does not match!");
            }

            // If they made it this far they are in!
            // Lets fill up their User object and send it back to React
            $userRole = UserRoleFactory::getUserRoles($user->getId());

            foreach ($userRole as $role) {
                $roles[] = $role['name'];
            }

            // return temporary access token during testing/development
            return $this->sendOutput(
                json_encode([
                    'id' => $user->getId(),
                    'apiaryid' => $user->getApiaryId(),
                    'username' => $user->getUsername(),
                    'email' => $user->getEmail(),
                    'roles' => $roles,
                    'accessToken' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c'
                ]),
                array('Content-Type: application/json', 'HTTP/2 200 OK')
            );
        } catch (\Exception $e) {
            return $this->sendOutput(
                json_encode(['error' => $e->getMessage()]),
                array('Content-Type: application/json', 'HTTP/1.1 500 Internal Server Error')
            );
        }

    }


}
