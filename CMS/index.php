<?php

require __DIR__ . '/inc/all.inc.php';

$container = new App\Support\Container();
$container->bind('pdo', fn() => require __DIR__ . '/inc/db-connect.inc.php');
$container->bind('pagesRepository', function() use($container) {
    return new App\Repository\PagesRepository($container->get('pdo'));
});
$container->bind('pagesController', function() use($container) {
    return new App\Frontend\Controller\PagesController($container->get('pagesRepository'));
});
$container->bind('notFoundController', function() use($container) {
    return new App\Frontend\Controller\NotFoundController($container->get('pagesRepository'));
});

$container->bind('pagesAdminController', fn() => new App\Admin\Controller\PagesAdminController($container->get('pagesRepository')));

$container->bind('authService', fn() => new App\Admin\Helper\AuthService($container->get('pdo')));
$container->bind('loginController', fn() => new App\Admin\Controller\LoginController($container->get('authService')));

$container->bind('csrfToken', fn() => new App\Admin\Helper\CSRFToken());


$csrfToken = $container->get('csrfToken');

$csrfToken->handle();
function csrf_token(){
    global $csrfToken;
    return $csrfToken->generate_token();
}

$route = (string) ($_GET['route'] ?? 'pages');


switch ($route) {
    case 'pages':
        $page = (string) ($_GET['page'] ?? 'index');
        $container->get('pagesController')->showPage($page);
        break;

    case 'admin/login':
        $container->get('loginController')->login();
        break;

    case 'admin/logout':
        $container->get('loginController')->logout();
        break;

    default:
        $adminPagesRoutes = [
            'admin/pages'         => ['index',  'pages/index.view'],
            'admin/pages/create'  => ['create', 'pages/create.view'],
            'admin/pages/delete'  => ['delete', 'pages/delete.view'],
            'admin/pages/update'  => ['update', 'pages/update.view'],
        ];

        if (isset($adminPagesRoutes[$route])) {
            $authService = $container->get('authService');
            $authService->ensureLoggedIn();

            [$method, $view] = $adminPagesRoutes[$route];
            $container->get('pagesAdminController')->{$method}($view);
        } else {
            $container->get('notFoundController')->error404();
        }
        break;
}
