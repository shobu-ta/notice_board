<h1><?= h($section->name) ?></h1>

<ul>
<?php foreach ($section->posts as $post) : ?>
    <li>
        <?= $this->Html->link(
        h($post->title),
        ['controller' => 'Posts', 'action' => 'view', $post->id]
        ) ?>
    【
    <?php if (!empty($post->user)) : ?>
        <?= $this->Html->link(
            h($post->user->username), 
            ['controller' => 'Users', 'action' => 'view', $post->user->id]
            ) ?>
        <?php else : ?><span>不明なユーザー</span>
    <?php endif; ?>
    】
    </li>
<?php endforeach; ?>
</ul>




