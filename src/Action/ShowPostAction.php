<?php
declare(strict_types=1);

namespace App\Action;

use App\Domain\Post\PostReader;
use App\Service\Template;
use App\Traits\FlashBanner;
use Parsedown;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;

class ShowPostAction
{
    use FlashBanner;

    public function __construct(
        private Template   $template, // Resolve by service definition
        private PostReader $listing,  // Resolve by Auto-wiring from TypeHint
        private Parsedown  $markdown
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

        $this->setFlashData($this->template, $request->getQueryParams());
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