<?php

require __DIR__ . '/inc/all.inc.php';

$page = (string) ($_GET['page'] ?? 'index');

if($page === 'index') {
    $pageController = new \App\Frontend\Controller\PagesController();
    $pageController->showPage('index');
} else {
    $notFoundController = new \App\Frontend\Controller\NotFoundController();
    $notFoundController->error404();
}