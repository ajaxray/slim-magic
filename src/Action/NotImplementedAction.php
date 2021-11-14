<?php
declare(strict_types=1);

namespace App\Action;

use App\Service\PostReader;
use App\Service\Template;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class NotImplementedAction
{
    public function __construct(
        private Template $template,
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