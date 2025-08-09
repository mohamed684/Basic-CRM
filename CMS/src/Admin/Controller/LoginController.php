<?php

namespace App\Admin\Controller;

class LoginController extends AbstractAdminController {
    public function login() {
        var_dump($_POST);
        $this->render('auth/login.view', []);
    }
}