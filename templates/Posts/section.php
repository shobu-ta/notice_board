<h1><?= h($section->name) ?></h1>

<ul>
<?php foreach ($section->posts as $post) : ?>
    <li>
        <?= h($post->title) ?>
        (<?= h($post->user->name ?? '') ?>)
    </li>
<?php endforeach; ?>
</ul>