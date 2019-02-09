<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\KanjiReading $kanjiReading
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $kanjiReading->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $kanjiReading->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Kanji Readings'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="kanjiReadings form large-9 medium-8 columns content">
    <?= $this->Form->create($kanjiReading) ?>
    <fieldset>
        <legend><?= __('Edit Kanji Reading') ?></legend>
        <?php
            echo $this->Form->control('ucs');
            echo $this->Form->control('type');
            echo $this->Form->control('reading');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
