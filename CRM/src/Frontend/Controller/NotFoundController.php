<?php 

namespace App\Frontend\Controller;


class NotFoundController {

    public function error404(): void {
        http_response_code(404);
        echo 'Error 404 From Controller';
    }

}
