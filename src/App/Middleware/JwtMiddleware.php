<?php

namespace src\App\Middleware;

use Firebase\JWT\JWT;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

class JwtMiddleware
{
    private $secretKey;

    public function __construct($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $response = new Response();
        $jwt = $this->getTokenFromHeader($request->getHeaderLine('Authorization'));

        if (!$jwt) {
            $response = $response->withStatus(401, 'Unauthorized');
            $response->getBody()->write('Unauthorized');
            return $response;
        }

        try {
            $decodedJwt = JWT::decode($jwt, $this->secretKey, array('HS256'));
            $request = $request->withAttribute('user', (array)$decodedJwt->data);
            $response = $handler->handle($request);
        } catch (\Exception $e) {
            $response = $response->withStatus(401, 'Unauthorized');
            $response->getBody()->write('Unauthorized');
        }

        return $response;
    }

    private function getTokenFromHeader($headerValue)
    {
        if (preg_match('/Bearer\s+(.*)$/i', $headerValue, $matches)) {
            return $matches[1];
        }
        return null;
    }
}

