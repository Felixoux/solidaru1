<?php
App\Helper::sessionStart();
require AUTOLOAD_PATH;

use App\{Connection, Helpers\Text, Model\Post, Router, Table\PostTable};
$id = (int)$params['id'];
$slug = $params['slug'];
$pdo = Connection::getPDO();
$table = new PostTable($pdo);
/** @var Post|false */
$post = $table->find($id);

[$images, $files] = $table->getAttach($id);

if ($post === false) {
    header('location: /');
}

$pageTitle = $post->getName();
$pageSummary = $post->getExerpt(150);

if ($post->getSlug() !== $slug) {
    $url = $router->url('post', ['slug' => $post->getSlug(), 'id' => $id]);
    http_response_code(301);
    header('Location: ' . $url);
    exit();
}
?>
<header class="article__header page-header flex">
    <h1 class="article__title section-title">
        <?= Text::strong(3, $post->getName()) ?>
    </h1>
    <p class="mobile-hidden muted"><?= $post->getCreatedAt()->format("d/m/Y") ?></p>
</header>
<section class="article">
    <?php if ($post->getImage()): ?>
        <!--<img src="<?/*= $post->getImageURL('small') */?>" alt="">-->
    <?php endif ?>
    <div class="article__content">
        <?= $post->getBody() ?>
    </div>
    <div class="article__files">
        <hr>
        <h3 class="medium-title mb3">Document(s) disponible(s) :</h3>
        <?php foreach ($files as $k => $file) {
            $name = $file['name'];
            $link = '/uploads/files' . DIRECTORY_SEPARATOR . $file['name'];
            echo <<<HTML
            <p>
                <a href="$link">$name</a>
            </p>
            HTML;
        }
        ?>
    </div>
    <a class="article__button btn-primary-outline" href="<?= $_SESSION['category_link'] ?>">Revenir à la catégorie</a>
</section>
<div class="carroussel-container my5" style="background: var(--bg-card);border: 1px solid var(--border)">
    <?php foreach ($images as $k => $image) {
        $name = $image['name'];
        $link = $router->url('image') . "?name=".$name."&width=10&height=10";
        echo <<<HTML
    <div class="blur-img">
        <img class="lazy" src="$link" alt="$name" data-name="$name" width="350" loading="eager">
    </div>
HTML;
    }
    ?>
</div>
<?php
// Slick carousel
$css_slick = <<<HTML
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
HTML;
$beforeBodyContent = ob_before($css_slick);

$js_slick = <<<JS
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
    $(document).ready(function () {
    $('.carroussel-container').slick({
    infinite: true,
    speed: 300,
    slidesToShow: 1
        })
             
    $('.slick-prev').html('&lt;')
    $('.slick-next').html('&gt;')
    })
</script>
JS;
$afterBodyContent = ob_after($js_slick);
