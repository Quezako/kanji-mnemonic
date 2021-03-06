<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Mnemonic $mnemonic
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Mnemonics'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="mnemonics form large-9 medium-8 columns content">
    <?= $this->Form->create($mnemonic) ?>
    <fieldset>
        <legend><?= __('Add Mnemonic') ?></legend>
        <?php
            echo $this->Form->control('reference');
            echo $this->Form->control('mnemonic');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
