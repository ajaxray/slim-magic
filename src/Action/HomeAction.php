<?php
declare(strict_types=1);

namespace App\Action;

use App\Service\PostReader;
use App\Service\TemplateService;
use App\Traits\FlashBanner;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HomeAction
{
    use FlashBanner;

    public function __construct(
        private TemplateService $template,
        private PostReader      $listing,
    ){
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $params = $request->getQueryParams();
        $page = isset($params['page']) ? intval($params['page']) : 1;

        $this->template->set([
            'list' => $this->listing->getPaginated($page),
            'currentPage'  => $page,
        ]);

        $this->template->set([
            'sidebar' => $this->template->render('_sidebar'),
            'content' => $this->template->render('home'),
        ]);

        $this->setFlashData($this->template, $params);

        // $response->getBody()->write('Hello, World agan!');
        $response->getBody()->write($this->template->render('layout'));

        return $response;
    }
}