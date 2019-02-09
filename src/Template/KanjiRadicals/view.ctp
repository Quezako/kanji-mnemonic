<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\KanjiRadical $kanjiRadical
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Kanji Radical'), ['action' => 'edit', $kanjiRadical->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Kanji Radical'), ['action' => 'delete', $kanjiRadical->id], ['confirm' => __('Are you sure you want to delete # {0}?', $kanjiRadical->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Kanji Radicals'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Kanji Radical'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="kanjiRadicals view large-9 medium-8 columns content">
    <h3><?= h($kanjiRadical->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Ucs') ?></th>
            <td><?= h($kanjiRadical->ucs) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($kanjiRadical->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Radical Id') ?></th>
            <td><?= $this->Number->format($kanjiRadical->radical_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Kanji Grade') ?></th>
            <td><?= $this->Number->format($kanjiRadical->kanji_grade) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Kanji Strokes') ?></th>
            <td><?= $this->Number->format($kanjiRadical->kanji_strokes) ?></td>
        </tr>
    </table>
</div>
