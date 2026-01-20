<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post $post
 * @var \Cake\Collection\CollectionInterface|string[] $users
 * @var \Cake\Collection\CollectionInterface|string[] $sections
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Posts'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="posts form content">
            <?= $this->Form->create($post) ?>
            <fieldset>
                <?php
                    $identity = $this->request->getAttribute('identity');
                    if ($identity) {
                    echo '<p><strong>' . h($identity->username) . ' の新規投稿</strong></p>';
                 }
                    echo $this->Form->control('title');
                    echo $this->Form->control('body');
                    echo $this->Form->control('published',['type'=>'checkbox', 'label'=>'公開する']);
                // sections._ids が分かりにくい件:この投稿に関連する section の id を複数扱う 多対多の魔法ワード
                    echo $this->Form->control('sections._ids', ['options' => $sections]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
