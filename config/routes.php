<?php
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;

return function (App $app) {
    $app->get('/', \App\Action\HomeAction::class)->setName('home');
    $app->post('/users', \App\Action\UserCreateAction::class);

    $app->get('/posts/{id:[0-9]+}', \App\Action\ShowPostAction::class);
    $app->get('/posts/new', \App\Action\CreatePostAction::class);
    $app->post('/posts', \App\Action\CreatePostAction::class);
};