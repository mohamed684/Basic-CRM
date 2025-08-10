<?php

namespace App\Admin\Helper;

class CSRFToken {
    public function handle() {
        $this->ensureSession();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!empty($_POST['_csrf']) && !empty($_SESSION['CSRFToken']) && $_POST['_csrf'] === $_SESSION['CSRFToken']) {
                unset($_SESSION['CSRFToken']);
                return;
            }
            http_response_code(419);
            echo 'CSRF Token Mismatch';
            die();
        }
    }

    public function ensureSession() {
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function generate_token(): string {
        if(empty($_SESSION['CSRFToken'])) {
            $token = bin2hex(random_bytes(32));
            $_SESSION['CSRFToken'] = $token;
        }
        return $_SESSION['CSRFToken'];
    }
}