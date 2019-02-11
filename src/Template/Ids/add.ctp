<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Id $id
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Ids'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="ids form large-9 medium-8 columns content">
    <?= $this->Form->create($id) ?>
    <fieldset>
        <legend><?= __('Add Id') ?></legend>
        <?php
            echo $this->Form->control('ids');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
