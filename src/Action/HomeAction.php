<?php
declare(strict_types=1);

namespace App\Action;

use App\Service\PostListing;
use App\Service\TemplateService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HomeAction
{
    public function __construct(
        private TemplateService $template,
        private PostListing $listing,
    ){
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $params = $request->getQueryParams();
        $page = $params['page'] ?? 1;

        $this->template->set(['posts' => $this->listing->getPaginated($page)]);

        $this->template->set([
            'sidebar' => $this->template->render('_sidebar'),
            'content' => $this->template->render('home'),
        ]);

        if (isset($params['success'])) {
            $this->template->set([
                'flash_type' => 'success',
                'flash_message' => ucfirst($params['success']) . " {$params['action']} successfully",
            ]);
        }

        // $response->getBody()->write('Hello, World agan!');
        $response->getBody()->write($this->template->render('layout'));

        return $response;
    }
}