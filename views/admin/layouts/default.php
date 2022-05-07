<!DOCTYPE html>
<html lang="fr" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solidarité | <?= isset($pageTitle) ? e($pageTitle) : 'Blog' ?></title>
    <link rel="shortcut icon" href="/img/svg/favicon.svg">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div id="pre-loader" class="active flex-center">
    <div class="loader"></div>
</div>
<div class="page-wrapper relative">
    <nav class="header header-admin">
        <ul class="header-nav">
            <li class="header__home"><a class="underline" href="<?= $router->url('home') ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12" fill="#EBF1FF" id="home">
                        <path fill="currentColor" d="M0 4v7a1 1 0 001 1h3V8h4v4h3a1 1 0 001-1V4L6 0 0 4z"></path>
                    </svg></a></li>
            <li><h4><a href="<?= $router->url('admin_posts') ?>">Posts</a></h4></li>
            <li><h4><a href="<?= $router->url('admin_categories') ?>">Catégorie</a></h4></li>
            <li><h4><a href="<?= $router->url('security') ?>">Sécurité</a></h4></li>
        </ul>
        <ul class="header-side">
            <li class="header__logout">
                <form action="<?= $router->url('logout') ?>" method="POST">
                    <button type="submit">
                        <svg fill="#F0F5FF" xmlns="http://www.w3.org/2000/svg"
                             width="512.000000pt" height="512.000000pt" viewBox="0 0 512.000000 512.000000"
                             preserveAspectRatio="xMidYMid meet">

                            <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                                stroke="none">
                                <path d="M482 5090 c-178 -47 -332 -171 -411 -331 -76 -154 -71 2 -71 -2199 0
-1696 2 -1985 15 -2045 49 -232 236 -425 471 -485 74 -19 115 -20 1094 -20
l1016 0 51 25 c72 36 106 90 111 175 4 81 -23 140 -87 185 l-43 30 -1021 5
-1022 5 -40 22 c-50 27 -80 58 -100 105 -13 33 -15 251 -15 1998 0 1747 2
1965 15 1998 20 47 50 78 100 105 l40 22 1022 5 1021 5 43 30 c64 45 91 104
87 185 -5 85 -39 139 -111 175 l-51 25 -1020 -1 c-972 0 -1025 -1 -1094 -19z"/>
                                <path d="M3556 4040 c-135 -43 -196 -206 -118 -317 15 -21 232 -240 482 -488
250 -247 457 -453 458 -457 2 -5 -563 -8 -1255 -8 l-1259 0 -44 -22 c-55 -29
-95 -79 -112 -140 -24 -91 24 -190 112 -235 l44 -23 1259 0 c692 0 1257 -3
1255 -8 -1 -4 -208 -210 -458 -457 -250 -248 -467 -467 -482 -488 -121 -172
85 -399 275 -300 40 20 1363 1327 1385 1368 22 40 22 150 0 190 -22 42 -1345
1348 -1386 1369 -40 21 -117 29 -156 16z"/>
                            </g>
                        </svg>
                    </button>
                </form>
            </li>
            <li class="header__burger">
                <button id="js-burger">
                    <span>Afficher le menu</span>
                </button>
            </li>
        </ul>
    </nav>
    <div class="container mb4">
        <?= $content ?>
    </div>
</div>
<script src=<?= "/js/jquery-3.6.0.min.js" ?>></script>
<script src=<?= "/js/app.js" ?>></script>
</body>
</html>






