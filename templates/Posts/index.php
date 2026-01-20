<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Post> $posts
 */
?>
<div class="posts index content">
    <?= $this->Html->link(__('New Post'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Posts') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('published') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                <tr>
                    <td><?= $this->Number->format($post->id) ?></td>
                    <td><?= $post->hasValue('user') ? $this->Html->link($post->user->username, ['controller' => 'Users', 'action' => 'view', $post->user->id]) : '' ?></td>
                    <td><?= h($post->title) ?></td>
                    <td><?= h($post->published) ? '公開' : '下書き' ?></td>
                    <td><?= h($post->created) ?></td>
                    <td><?= h($post->modified) ?></td>
                   <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $post->id]) ?>

                        <?php if (
                            $this->Identity->isLoggedIn() &&
                            (
                                $this->Identity->get('role') === 'admin' ||
                                $post->user_id === $this->Identity->get('id')
                            )
                        ): ?>
                            <?= $this->Html->link('編集', ['action' => 'edit', $post->id]) ?>

                            <?= $this->Form->postLink(
                                '削除',
                                ['action' => 'delete', $post->id],
                                ['confirm' => '本当に削除しますか？']
                            ) ?>
                        <?php endif; ?>
                    </td>

                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>