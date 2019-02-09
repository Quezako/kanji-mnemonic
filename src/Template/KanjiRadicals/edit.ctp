<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\KanjiRadical $kanjiRadical
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $kanjiRadical->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $kanjiRadical->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Kanji Radicals'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="kanjiRadicals form large-9 medium-8 columns content">
    <?= $this->Form->create($kanjiRadical) ?>
    <fieldset>
        <legend><?= __('Edit Kanji Radical') ?></legend>
        <?php
            echo $this->Form->control('ucs');
            echo $this->Form->control('radical_id');
            echo $this->Form->control('kanji_grade');
            echo $this->Form->control('kanji_strokes');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
