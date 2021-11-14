<?php
declare(strict_types=1);

namespace App\Action;

use App\Service\Template;
use App\Traits\CsrfProtection;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use Slim\Csrf\Guard;

class LoginAction
{
    use CsrfProtection;

    public function __construct(
        private Template $template,
        private Guard    $csrf,
        private App      $app,
    ){
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
    ): ResponseInterface {

        if ($request->getMethod() == 'POST') {
            $data = (array) $request->getParsedBody();
            $auth = $this->app->getContainer()->get('settings')['auth'];

            if ($auth['user'] == $data['username'] && $auth['pass'] == $data['password']) {
                $_SESSION['user'] = $data['username'];

                return $response
                    ->withStatus(301)
                    ->withHeader('Location', '/?success=logged&action=in');
            } else {
                $this->template->set(['failed' => true]);
            }
        }

        $this->setCSRFFields($request, $this->template, $this->csrf);
        $this->template->set([
            'content' => $this->template->render('login'),
        ]);

        // $response->getBody()->write('Hello, World agan!');
        $response->getBody()->write($this->template->render('layout_centred'));

        return $response;
    }
}