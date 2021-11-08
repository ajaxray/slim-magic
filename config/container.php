<?php
use Ajaxray\Magic\Magic;
use Doctrine\DBAL\Connection;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Middleware\ErrorMiddleware;
use Selective\BasePath\BasePathMiddleware;

return function (Magic $container) {

    $container->param('dsn', 'mysql://apps:bismillah@localhost/slim-blog?charset=UTF8');


    $container->map('settings', function ($m, $params) {
        return require __DIR__ . '/settings.php';
    });

    $container->map(App::class, function (ContainerInterface $container, $params) {
        AppFactory::setContainer($container);
        return AppFactory::create();
    });

    $container->map(ResponseFactoryInterface::class, function (ContainerInterface $container, $params) {
        return $container->get(App::class)->getResponseFactory();
    });

//    $container->map(ContainerInterface::class, function (ContainerInterface $container, $params) {
//        return $container;
//    });

    $container->map(ErrorMiddleware::class, function (ContainerInterface $container, $params) {
        $app = $container->get(App::class);
        $settings = $container->get('settings')['error'];

        return new ErrorMiddleware(
            $app->getCallableResolver(),
            $app->getResponseFactory(),
            (bool)$settings['display_error_details'],
            (bool)$settings['log_errors'],
            (bool)$settings['log_error_details']
        );
    });

    $container->map(BasePathMiddleware::class, function (ContainerInterface $container, $params) {
        return new BasePathMiddleware($container->get(App::class));
    });

    $container->map(Connection::class, function (ContainerInterface $container, $params) {
        return \Doctrine\DBAL\DriverManager::getConnection(['url' => $params['dsn']]);
    });

    $container->map('template', \App\Service\TemplateService::class, ['@cacheable' => false]);
};