<?php

namespace App\Frontend\Controller;

class PagesController extends AbstractController {

    public function showPage($pageKey) {
        $this->render('pages/showPage.view', []);
    }
}