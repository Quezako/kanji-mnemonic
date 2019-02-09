<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\KanjiCode $kanjiCode
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Kanji Code'), ['action' => 'edit', $kanjiCode->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Kanji Code'), ['action' => 'delete', $kanjiCode->id], ['confirm' => __('Are you sure you want to delete # {0}?', $kanjiCode->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Kanji Codes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Kanji Code'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="kanjiCodes view large-9 medium-8 columns content">
    <h3><?= h($kanjiCode->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Ucs') ?></th>
            <td><?= h($kanjiCode->ucs) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Section') ?></th>
            <td><?= h($kanjiCode->section) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($kanjiCode->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Value') ?></th>
            <td><?= h($kanjiCode->value) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($kanjiCode->id) ?></td>
        </tr>
    </table>
</div>
