<?php

require __DIR__ . '/inc/all.inc.php';

$route = (string) ($_GET['route'] ?? 'pages');


if($route === 'pages') {
    $page = (string) ($_GET['page'] ?? 'index');

    $pageRepository = new \App\Repository\PagesRepository($pdo);

    $pageController = new \App\Frontend\Controller\PagesController($pageRepository);
    $pageController->showPage($page);
} else {
    $notFoundController = new \App\Frontend\Controller\NotFoundController();
    $notFoundController->error404();
}