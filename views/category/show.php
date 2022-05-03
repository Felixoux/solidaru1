<?php
require AUTOLOAD_PATH;

use App\{Connection, Table\CategoryTable, Table\PostTable};

$id = (int)$params['id'];
$slug = $params['slug'];
$pdo = Connection::getPDO();
$category = (new CategoryTable($pdo))->find($id);


if ($category->getSlug() !== $slug) {
    $url = $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]);
    http_response_code(301);
    header('Location: ' . $url);
    exit();
}

[$posts, $pagination] = (new PostTable($pdo))->findPaginatedForCategory($category->getID());

$link = $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]);
?>

<section class="event">
    <div class="header-section flex">
        <h2 id="event">Voici les posts liés au thème <strong><?= e($category->getName()) ?></strong></h2>
    </div>
    <p class="js-hide"><?= $category->getContent() ?></p>
    <a class="button-js-hide">Voir plus</a>
    <div class="big-grid-event">
        <?php foreach ($posts as $post): ?>
            <?php require VIEW_PATH . '/post/card.php'; ?>
        <?php endforeach ?>
    </div>
    <div class="footer-links">
        <?= $pagination->previousLink($link) ?>
        <?= $pagination->nextLink($link) ?>
    </div>
</section>
   
