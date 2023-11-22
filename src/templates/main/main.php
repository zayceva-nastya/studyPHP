<?php include __DIR__ . '/../header.php'; ?>
<?php foreach ($articles as $article): ?>
    <a href="articles/<?= $article->getId() ?>"><h2><?= $article->getName() ?></h2></a>
    <p><?= $article->getText() ?></p>
    <hr>
<?php endforeach; ?>
<?php include __DIR__ . '/../footer.php'; ?>