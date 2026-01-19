<div class="users form">
    <?= $this->Flash->render() ?>

    <h3>ログイン</h3>

    <?= $this->Form->create() ?>
    <fieldset>
        <?= $this->Form->control('username', ['required' => true]) ?>
        <?= $this->Form->control('password', ['required' => true]) ?>
    </fieldset>

    <?= $this->Form->submit('ログイン') ?>
    <?= $this->Form->end() ?>
</div>
