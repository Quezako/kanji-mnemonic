<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\KanjiMeaning $kanjiMeaning
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Kanji Meaning'), ['action' => 'edit', $kanjiMeaning->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Kanji Meaning'), ['action' => 'delete', $kanjiMeaning->id], ['confirm' => __('Are you sure you want to delete # {0}?', $kanjiMeaning->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Kanji Meanings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Kanji Meaning'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="kanjiMeanings view large-9 medium-8 columns content">
    <h3><?= h($kanjiMeaning->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Ucs') ?></th>
            <td><?= h($kanjiMeaning->ucs) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Language') ?></th>
            <td><?= h($kanjiMeaning->language) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Meaning') ?></th>
            <td><?= h($kanjiMeaning->meaning) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($kanjiMeaning->id) ?></td>
        </tr>
    </table>
</div>
