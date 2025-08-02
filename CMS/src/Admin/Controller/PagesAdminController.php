<?php

namespace App\Admin\Controller;

use App\Repository\PagesRepository;

class PagesAdminController extends AbstractAdminController {

    public function __construct(private PagesRepository $pagesRepository) {}

    public function index($page) {
        $pages = $this->pagesRepository->get();
        $this->render($page, [
            'pages' => $pages
        ]);
    }

    public function create($page) {
        $errors = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
            $title = (string) $_POST['title'];
            $slug = (string) $_POST['slug'];
            $content = (string) $_POST['content'];

            $slug = strtolower($slug);
            $slug = preg_replace('/[^a-z0-9\-]/', '', $slug);


            if(!empty($title) && !empty($slug) && !empty($content)) {
                if(!$this->pagesRepository->isSlugExists($slug)) {
                    $this->pagesRepository->create($title, $slug, $content);
                    header('Location: index.php?route/admin');
                    return;
                } else {
                    $errors[] = 'Slug Already Exists';
                }
            } else {
                $errors[] = 'Please Fill All The Fields!';
            }
        }
        
        $this->render($page, [
            'errors' => $errors
        ]);
    }
}