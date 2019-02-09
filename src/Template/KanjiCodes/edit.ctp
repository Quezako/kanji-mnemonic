<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\KanjiCode $kanjiCode
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $kanjiCode->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $kanjiCode->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Kanji Codes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="kanjiCodes form large-9 medium-8 columns content">
    <?= $this->Form->create($kanjiCode) ?>
    <fieldset>
        <legend><?= __('Edit Kanji Code') ?></legend>
        <?php
            echo $this->Form->control('ucs');
            echo $this->Form->control('section');
            echo $this->Form->control('type');
            echo $this->Form->control('value');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
