<?php
use Ajaxray\Magic\Magic;
use Doctrine\DBAL\Connection;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\App;
use Slim\Csrf\Guard;
use Slim\Factory\AppFactory;
use Slim\Middleware\ErrorMiddleware;
use Selective\BasePath\BasePathMiddleware;

return function (Magic $container) {

    //<editor-fold desc="Service definitions required by Slim">
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
    //</editor-fold>

    // ======== Define Parameters ================

    // @see - https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html#connecting-using-a-url
    $container->param('dsn', 'mysql://user:pass@db/blog?charset=UTF8');

    // ======== Define Services ================
    $container->map(Connection::class, function (ContainerInterface $container, $params) {
        return \Doctrine\DBAL\DriverManager::getConnection(['url' => $params['dsn']]);
    });

    $container->map(BasePathMiddleware::class, function (ContainerInterface $container, $params) {
        return new BasePathMiddleware($container->get(App::class));
    });

    // Define service by simple class mapping
    $container->map('template', \App\Service\Template::class, ['@cacheable' => false]);

    // Define service using callback function
    $container->map('csrf', function (ContainerInterface $container, $params) {
        $responseFactory = $container->get(ResponseFactoryInterface::class);
        return new Guard($responseFactory);
    });
};