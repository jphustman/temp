<?php
namespace src\App\Middleware;
use src\App\Middleware\JwtAuth;
use Exception;
use Firebase\JWT\SignatureInvalidException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Exception\HttpForbiddenException;

final class BearerAuthMiddleware implements MiddlewareInterface
{
    private JwtAuth $jwtAuth;
    public function __construct(JwtAuth $jwtAuth)
    {
        $this->jwtAuth = $jwtAuth;
    }
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        try {
// Get token from "Authorization" header
            $jwt = explode(' ', (string)$request->getHeaderLine('authorization'))[1] ?? '';
            if (!$jwt) {
                throw new SignatureInvalidException('No Bearer Token provided');
            }
// Validate and decode token
            $payload = $this->jwtAuth->decode($jwt);
// Optional, map payload data to DTO
            $user = (array)($payload->data ?? []);
            // Add current user details to request
            $request = $request->withAttribute('user', $user);
            return $handler->handle($request);
        } catch (Exception $exception) {
            throw new HttpForbiddenException($request, 'Unauthorized', $exception);
        }
    }
}
