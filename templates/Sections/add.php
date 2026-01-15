<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Section $section
 * @var \Cake\Collection\CollectionInterface|string[] $posts
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Sections'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="sections form content">
            <?= $this->Form->create($section) ?>
            <fieldset>
                <legend><?= __('Add Section') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('posts._ids', ['options' => $posts]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
