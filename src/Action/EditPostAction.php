<?php
declare(strict_types=1);

namespace App\Action;

use App\Domain\Post\PostMaker;
use App\Domain\Post\PostReader;
use App\Exception\ValidationException;

use App\Service\Template;
use App\Traits\CsrfProtection;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Csrf\Guard;
use Slim\Exception\HttpNotFoundException;

class EditPostAction
{
    use CsrfProtection;

    public function __construct(
        private Template   $template,  // Resolve by name matching
        private PostMaker  $postService,     // Resolve by Auto-wiring
        private PostReader $listing,
        private Guard      $csrf,
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

        if ($request->getMethod() == 'POST') {
            $data = (array)$request->getParsedBody();
            $this->cleanCSRFFields($this->csrf, $data);

            try {
                $this->postService->updatePost(intval($post['id']), $data);
                return $response
                    ->withStatus(301)
                    ->withHeader('Location', "/posts/{$args['id']}?success=post&action=updated");

            } catch (ValidationException $exception) {
                $this->template->set(['errors' => $exception->getErrors()]);
            }
        }

        $this->template->set(['post' => $post]);
        $this->setCSRFFields($request, $this->template, $this->csrf);
        $body = $this->template->set([
            'sidebar' => $this->template->render('_sidebar'),
            'content' => $this->template->render('post/edit'),
        ]);

        $response->getBody()->write($body->render('layout'));

        return $response;
    }
}