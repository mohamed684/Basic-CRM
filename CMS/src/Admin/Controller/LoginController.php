<?php

namespace App\Admin\Controller;

use App\Admin\Helper\AuthService;

class LoginController extends AbstractAdminController {

    public function __construct(private AuthService $authService) {}

    public function login() {
        $loginError = false;
        if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if(!empty($username) && !empty($password)) {
                $user_authenticated = $this->authService->handleLogin($username, $password);
                if($user_authenticated) {
                    header('Location: index.php?route=admin/pages');
                }
            }
        }

        $loginError = true;

        $this->render('auth/login.view', [
            'loginError' => $loginError
        ]);
    }
}