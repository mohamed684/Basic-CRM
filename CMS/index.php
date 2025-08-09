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

$route = (string) ($_GET['route'] ?? 'pages');


// if($route === 'pages') {
//     $page = (string) ($_GET['page'] ?? 'index');

//     $pagesController = $container->get('pagesController');
//     $pagesController->showPage($page);
// } else if($route === 'admin/login') {
//     $loginController = $container->get('loginController');
//     $loginController->login();
// } else if($route === 'admin/pages') {
//     $pagesAdminController = $container->get('pagesAdminController');
//     $pagesAdminController->index('pages/index.view');
// } else if($route === 'admin/pages/create') {
//     $pagesAdminController = $container->get('pagesAdminController');
//     $pagesAdminController->create('pages/create.view');
// } else if($route === 'admin/pages/delete') {
//     $pagesAdminController = $container->get('pagesAdminController');
//     $pagesAdminController->delete('pages/delete.view');
// } else if($route === 'admin/pages/update') {
//     $pagesAdminController = $container->get('pagesAdminController');
//     $pagesAdminController->update('pages/update.view');
// } else {
//     $notFoundController = $container->get('notFoundController');
//     $notFoundController->error404();
// }

switch ($route) {
    case 'pages':
        $page = (string) ($_GET['page'] ?? 'index');
        $container->get('pagesController')->showPage($page);
        break;

    case 'admin/login':
        $container->get('loginController')->login();
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
