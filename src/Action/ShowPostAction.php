<?php
declare(strict_types=1);

namespace App\Action;

use App\Exception\ValidationException;
use App\Service\PostCreator;
use App\Service\PostListing;
use App\Service\TemplateService;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;

class ShowPostAction
{
    public function __construct(
        private TemplateService $template, // Resolve by service definition
        private PostListing $listing,  // Resolve by Auto-wiring
        private \Parsedown $markdown
    ) {
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     * @throws HttpNotFoundException
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface
    {
        // @TODO : Check if $args['id'] was set
        $post = $this->listing->getByID(intval($args['id']));

        if ($post === false) {
            throw new HttpNotFoundException($request);
        }

        $this->template->set(['post' => $this->formatPost($post)]);
        $body = $this->template->set([
            'sidebar' => $this->template->render('_sidebar'),
            'content' => $this->template->render('post/show'),
        ]);

        $response->getBody()->write($body->render('layout'));

        return $response;
    }

    /**
     * @param array $post
     * @return array
     */
    private function formatPost(array $post): array
    {
        $post['content'] = htmlentities($post['content']);
        $this->markdown->setSafeMode(true);
        $post['content'] = $this->markdown->text($post['content']);

        return $post;
    }
}