<?php

use App\Action\CreatePostAction;
use App\Action\EditPostAction;
use App\Action\HomeAction;
use App\Action\LoginAction;
use App\Action\LogoutAction;
use App\Action\NotImplementedAction;
use App\Action\ShowPostAction;
use Slim\App;

return function (App $app) {
    $app->get('/', HomeAction::class)->setName('home');
    $app->map(['GET', 'POST'], '/login', LoginAction::class)->setName('login')->add('csrf');
    $app->get('/logout', LogoutAction::class)->setName('logout');
    $app->get('/not-implemented', NotImplementedAction::class)->setName('not-implemented');
    // $app->post('/users', \App\Action\UserCreateAction::class);

    $app->get('/posts/{id:[0-9]+}', ShowPostAction::class);
    $app->map(['GET', 'POST'], '/posts/edit/{id:[0-9]+}', EditPostAction::class)->add('csrf');
    $app->get('/posts/new', CreatePostAction::class)->add('csrf');;
    $app->post('/posts', CreatePostAction::class)->add('csrf');
};