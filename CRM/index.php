<?php

require __DIR__ . '/inc/all.inc.php';

$page = (string) ($_GET['page'] ?? 'index');

if($page === 'index') {
    echo "It's {$page} Page <br>";
} else {
    $notFoundController = new \App\Frontend\Controller\NotFoundController();
    $notFoundController->error404();
}