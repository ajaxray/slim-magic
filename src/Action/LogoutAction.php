<?php
declare(strict_types=1);

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


class LogoutAction
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        unset($_SESSION['user']);

        return $response
            ->withStatus(301)
            ->withHeader('Location', '/?success=logged&action=out');
    }
}