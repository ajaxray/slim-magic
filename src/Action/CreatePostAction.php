<?php
declare(strict_types=1);

namespace App\Action;

use App\Domain\Post\PostMaker;
use App\Exception\ValidationException;

use App\Service\Template;
use App\Traits\CsrfProtection;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Csrf\Guard;

class CreatePostAction
{
    use CsrfProtection;

    public function __construct(
        private Template  $template, // Resolve by service definition
        private PostMaker $postCreator,  // Resolve by Auto-wiring
        private Guard     $csrf,               // Resolve by name matching
    ) {
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface
    {
        if ($request->getMethod() == 'POST') {
            $data = (array)$request->getParsedBody();

            try {
                $this->cleanCSRFFields($this->csrf, $data);
                $postId = $this->postCreator->createPost($data);
                return $response
                    ->withStatus(301)
                    ->withHeader('Location', '/?success=post&action=created');

            } catch (ValidationException $exception) {
                $this->template->set(['errors' => $exception->getErrors()]);
            }
        }

        $this->setCSRFFields($request, $this->template, $this->csrf);
        $body = $this->template->set([
            'sidebar' => $this->template->render('_sidebar'),
            'content' => $this->template->render('post/create'),
        ]);

        $response->getBody()->write($body->render('layout'));

        return $response;
    }

}