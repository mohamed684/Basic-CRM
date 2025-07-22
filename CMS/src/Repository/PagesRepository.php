<?php
declare(strict_types=1);

namespace App\Repository;

use PDO;
use App\Model\PageModel;

class PagesRepository {

    public function __construct(private PDO $pdo) {}

    public function fetchForNavigation(): array {
        $stmt = $this->pdo->prepare('SELECT * FROM pages ORDER BY id ASC');
        $stmt->execute();

        $pages = $stmt->fetchAll(PDO::FETCH_CLASS, PageModel::class);

        return $pages;
    }

    public function fetchBySlug(string $slug): ?PageModel {
        $stmt = $this->pdo->prepare('SELECT * FROM pages WHERE slug = :slug');
        $stmt->bindValue(':slug', $slug);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, PageModel::class);
        
        $page = $stmt->fetch();

        if(!empty($page)) {
            return $page;
        }

        return null;
    }

}