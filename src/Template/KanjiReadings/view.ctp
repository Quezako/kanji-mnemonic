<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\KanjiReading $kanjiReading
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Kanji Reading'), ['action' => 'edit', $kanjiReading->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Kanji Reading'), ['action' => 'delete', $kanjiReading->id], ['confirm' => __('Are you sure you want to delete # {0}?', $kanjiReading->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Kanji Readings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Kanji Reading'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="kanjiReadings view large-9 medium-8 columns content">
    <h3><?= h($kanjiReading->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Ucs') ?></th>
            <td><?= h($kanjiReading->ucs) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($kanjiReading->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reading') ?></th>
            <td><?= h($kanjiReading->reading) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($kanjiReading->id) ?></td>
        </tr>
    </table>
</div>
