<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\KanjiMeaning $kanjiMeaning
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Kanji Meanings'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="kanjiMeanings form large-9 medium-8 columns content">
    <?= $this->Form->create($kanjiMeaning) ?>
    <fieldset>
        <legend><?= __('Add Kanji Meaning') ?></legend>
        <?php
            echo $this->Form->control('ucs');
            echo $this->Form->control('language');
            echo $this->Form->control('meaning');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
