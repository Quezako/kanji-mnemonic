<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Alike $alike
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Alike'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="alike form large-9 medium-8 columns content">
    <?= $this->Form->create($alike) ?>
    <fieldset>
        <legend><?= __('Add Alike') ?></legend>
        <?php
            echo $this->Form->control('reference');
            echo $this->Form->control('hanzi');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
