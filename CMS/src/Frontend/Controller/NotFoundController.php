<?php 

namespace App\Frontend\Controller;


class NotFoundController extends AbstractController {

    public function error404(): void {
        http_response_code(404);
        
        $this->render('notFound/error404.view', []);
    }

}
