<?php

declare(strict_types=1);

namespace App\Controller;

use App\CustomResponse as Response;
use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use Psr\Http\Message\ServerRequestInterface as Request;
use Firebase\JWT\JWT;

use App\Models\Users;
use App\Models\Roles;

final class Auth
{
    private Container $container;
    private Users $user;
    private $roles;
    private $log;

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        $db = $this->container->get('db');
        $this->user = new Users($db);
        $this->roles = new Roles($db);
    }

    public function register(Request $request, Response $response): Response
    {
        $params = (array)$request->getParsedBody();
        $db = $this->container->get('db');

        $firstname = $params['firstname'];
        $lastname = $params['lastname'];
        $email = $params['email'];
        $username = $params['username'];
        $password = $params['password'];

        // Hash the password
        $password = password_hash($password, PASSWORD_BCRYPT);

        // Create a new user
        $result = $this->user->create([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'username' => $username,
            'password' => $password
        ]);

        if ($result['status'] === 'Error') {
            return $response->withJson($result);
        }

        $status = [
            'status' => 'Success',
            'message' => 'User successfully registered',
            'timestamp' => time(),
        ];

        return $response->withJson($status);
    }

    public function signin(Request $request, Response $response): Response
    {
        $params = (array)$request->getParsedBody();

        $username = $params['username'];
        $password = $params['password'];

        // Verify the user credentials
        $user = $this->user->getByUsername($username);
        if (!$user) {
            return $response->withStatus(404, 'Username does not exist.');
        }

        // https://www.techiediaries.com/php-jwt-authentication-tutorial/
        if (password_verify($password, $user['password'])) {
            $secret_key = $_ENV['JWT_SECRET'];
            $issuer_claim = "https://tradingleagues.com"; // this can be the servername
            $audience_claim = "THE_AUDIENCE";
            $issuedat_claim = Time(); // issued at
            $notbefore_claim = $issuedat_claim - 10; //not before in seconds
//            $expire_claim = $issuedat_claim.setDate() + 1; // expire time in seconds
            $token = array(
                "sub" => $username,
                "iss" => $issuer_claim,
                "aud" => $audience_claim,
                "iat" => $issuedat_claim,
                "nbf" => $notbefore_claim,
//                "exp" => $expire_claim,
                "data" => array(
                    "id" => $user['id'],
                    "firstname" => $user['username'],
                    "email" => $user['email']
                ));
        } else {
            return $response->withStatus(404, 'Incorrect password.');
        }

        $jwt = JWT::encode($token, $secret_key, 'HS256');

        $userRoles = $this->user->getRoles($user['id']);

        /*
        // Generate a JWT token
        $token = JWT::encode([
            'sub' => $user['id'],
            'iat' => time(),
            'ext' => time() + (60 * 60 * 24)
        ], $this->container->get('settings')['jwt']['secret']);
        */
        $status = [
            'status' => 'Success',
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'accessToken' => $jwt,
            'roles' => $userRoles,
            'timestamp' => time()
        ];

        return $response->withJson($status);
    }
}
