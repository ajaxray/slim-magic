<?php
declare(strict_types=1);

namespace App\Action;

use App\Exception\ValidationException;
use App\Service\PostCreator;
use App\Service\TemplateService;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Csrf\Guard;

class CreatePostAction
{
    public function __construct(
        private TemplateService $template, // Resolve by service definition
        private PostCreator $postCreator,  // Resolve by Auto-wiring
        private Guard $csrf,               // Resolve by name matching
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
                $postId = $this->postCreator->createPost($data);
                return $response
                    ->withStatus(301)
                    ->withHeader('Location', '/?success=post&action=created');

            } catch (ValidationException $exception) {
                $this->template->set(['errors' => $exception->getErrors()]);
            }
        }

        $this->setCSRF($request);
        $body = $this->template->set([
            'sidebar' => $this->template->render('_sidebar'),
            'content' => $this->template->render('post/create'),
        ]);

        $response->getBody()->write($body->render('layout'));

        return $response;
    }

    /**
     * @param ServerRequestInterface $request
     */
    private function setCSRF(ServerRequestInterface $request): void
    {
        $nameKey = $this->csrf->getTokenNameKey();
        $valueKey = $this->csrf->getTokenValueKey();

        $this->template->set([
            'nameKey' => $nameKey,
            'valueKey' => $valueKey,
            'name' => $request->getAttribute($nameKey),
            'value' => $request->getAttribute($valueKey),
        ]);
    }
}