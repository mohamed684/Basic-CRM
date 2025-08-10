<?php

namespace App\Admin\Controller;

class AbstractAdminController {

    public function __construct() {}

    protected function render($view, $params) {
        extract($params);

        ob_start();
        require __DIR__ . '/../../../views/admin/' . $view . '.php';
        $contents = ob_get_clean();

        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if(!empty($_SESSION['adminUserId'])) {
            $loggedIn = true;
        }

        require __DIR__ . '/../../../views/admin/layouts/main.view.php';
    }

    protected function error404(): void {
        http_response_code(404);
        
        $this->render('notFound/error404.view', []);
    }

}