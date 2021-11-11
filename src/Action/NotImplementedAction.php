<?php
declare(strict_types=1);

namespace App\Action;

use App\Service\PostListing;
use App\Service\TemplateService;
use App\Traits\CsrfProtection;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use Slim\Csrf\Guard;

class NotImplementedAction
{
    public function __construct(
        private TemplateService $template,
    ){
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
    ): ResponseInterface {

        $this->template->set([
            'content' => '<h5>This feature is not implemented yet!</h5>'
                       . '<p>Please <a href="javascript:window.history.back()">go back</a>.</p>'
        ]);

        $response->getBody()->write($this->template->render('layout_centred'));

        return $response;
    }
}