<section class="mt4">
    <form action="" method="POST">
        <?= $form->input('name', 'Titre') ?>
        <?= $form->input('slug', 'URL') ?>
        <?= $form->textarea('content', 'Résumé') ?>
        <button class="btn-primary">
            <?php if ($item->getID() !== null): ?>
                Modifier
            <?php else: ?>
                Créer
            <?php endif ?>
        </button>
    </form>
</section>
