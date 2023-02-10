<?php

declare(strict_types=1);

namespace App\Controller;

use App\CustomResponse as Response;
use DI\Container;
use Psr\Http\Message\ServerRequestInterface as Request;
use Firebase\JWT\JWT;

use App\Models\Users;

final class Auth
{
    private Container $container;
    private $model;
    private $log;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $db = $this->container->get('db');
        $this->model = new Users($db);
    }

    public function register(Request $request, Response $response): Response
    {
        $params = (array)$request->getParsedBody();
        $db = $this->container->get('db');

        $username = $params['username'];
        $email = $params['email'];
        $password = $params['password'];

        // Hash the password
        $password = password_hash($password, PASSWORD_BCRYPT);

        // Create a new user
        $result = $this->model->create([
            'username' => $username,
            'email' => $email,
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
        $user = $this->model->getByUsername($username);
        if (!$user) {
            return $response->withJson([
                'status' => 'Error',
                'message' => 'Invalid username',
                'timestamp' => time()
            ]);
        }

        // https://www.techiediaries.com/php-jwt-authentication-tutorial/
        if (password_verify($password, $user['password'])) {
            $secret_key = $_ENV['JWT_SECRET'];
            $issuer_claim = "TRADINGLEAGUES.COM"; // this can be the servername
            $audience_claim = "THE_AUDIENCE";
            $issuedat_claim = time(); // issued at
            $notbefore_claim = $issuedat_claim + 10; //not before in seconds
            $expire_claim = $issuedat_claim + 60; // expire time in seconds
            $token = array(
                "iss" => $issuer_claim,
                "aud" => $audience_claim,
                "iat" => $issuedat_claim,
                "nbf" => $notbefore_claim,
                "exp" => $expire_claim,
                "data" => array(
                    "id" => $user['id'],
                    "firstname" => $user['username'],
                    "email" => $user['email']
                ));
        } else {
            return $response->withJson([
                'status' => 'Error',
                'message' => 'Invalid password!',
                'timestamp' => time()
            ]);
        }

        $jwt = JWT::encode($token, $secret_key, 'HS256');

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
            'accessToken' => $jwt,
            'timestamp' => time()
        ];

        return $response->withJson($status);
    }
}
