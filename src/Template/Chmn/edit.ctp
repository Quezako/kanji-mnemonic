<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Chmn $chmn
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $chmn->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $chmn->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Chmn'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="chmn form large-9 medium-8 columns content">
    <?= $this->Form->create($chmn) ?>
    <fieldset>
        <legend><?= __('Edit Chmn') ?></legend>
        <?php
            echo $this->Form->control('number');
            echo $this->Form->control('hanzi');
            echo $this->Form->control('simplified');
            echo $this->Form->control('mnemonics');
            echo $this->Form->control('alike');
            echo $this->Form->control('mine');
            echo $this->Form->control('meaning');
            echo $this->Form->control('reference');
            echo $this->Form->control('remnant');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
