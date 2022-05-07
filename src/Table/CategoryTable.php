<?php

namespace App\Table;

use App\Model\Category;
use App\Model\Post;
use App\paginatedQuery;
use PDO;

class CategoryTable extends Table
{

    protected $table = "category";
    protected $class = Category::class;

    public function findPaginated()
    {
        $paginatedQuery = new paginatedQuery(
            "SELECT * FROM category ORDER BY name ASC",
            "SELECT COUNT(id) FROM category"
        );
        $categories = $paginatedQuery->getItems(Category::class);
        return [$categories, $paginatedQuery];
    }

    /** @param App\Model\Post[] $posts */
    public function hydratePosts(array $posts): void
    {
        $postByID = [];
        foreach ($posts as $post) {
            $post->setCategories([]);
            $postByID[$post->getID()] = $post;
        }
        $categories = $this->pdo
            ->query('
                SELECT c.*, pc.post_id
                FROM post_category pc
                JOIN category c ON c.id = pc.category_id
                WHERE pc.post_id IN (' . implode(',', array_keys($postByID)) . ')'
            )->fetchAll(PDO::FETCH_CLASS, Category::class);
        foreach ($categories as $category) {
            $postByID[$category->getPostID()]->addCategory($category);
        }
    }

    public function all(): array
    {
        return $this->queryAndFetchALl("SELECT * FROM $this->table ORDER BY id DESC");
    }

    public function list(): array
    {
        $categories = $this->queryAndFetchALl("SELECT * FROM $this->table ORDER BY name ASC");
        $results = [];
        foreach ($categories as $category) {
            $results[$category->getID()] = $category->getName();
        }
        return $results;
    }

    public function countByCategoryID(int $categoryID): int
    {
        $paginatedQuery = new paginatedQuery(
            "SELECT p.*
                FROM $this->table p
                JOIN post_category pc ON pc.post_id = p.id
                WHERE pc.category_id = $categoryID",
            "SELECT COUNT(category_id) FROM post_category WHERE category_id = $categoryID",
        );
        $posts = $paginatedQuery->getItems(Post::class);
        return dd($posts);
    }
}