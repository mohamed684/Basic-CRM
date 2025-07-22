<?php

namespace App\Frontend\Controller;
use App\Repository\PagesRepository;

class PagesController extends AbstractController {

    public function __construct(PagesRepository $pagesRepository) {
        parent::__construct($pagesRepository);
    }

    public function showPage($pageKey) {
        $page = $this->pagesRepository->fetchBySlug($pageKey);

        if(!empty($page)) {
            $this->render('pages/showPage.view', [
                'page' => $page
            ]);
        } else {
            $this->error404();
        }

    }
}