<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Kanji $kanji
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Kanji'), ['action' => 'edit', $kanji->ucs]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Kanji'), ['action' => 'delete', $kanji->ucs], ['confirm' => __('Are you sure you want to delete # {0}?', $kanji->ucs)]) ?> </li>
        <li><?= $this->Html->link(__('List Kanji'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Kanji'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="kanji view large-9 medium-8 columns content">
    <h3><?= h($kanji->ucs) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Ucs') ?></th>
            <td><?= h($kanji->ucs) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Kanji') ?></th>
            <td><?= h($kanji->kanji) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Jlpt') ?></th>
            <td><?= $this->Number->format($kanji->jlpt) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Grade') ?></th>
            <td><?= $this->Number->format($kanji->grade) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Strokes') ?></th>
            <td><?= $this->Number->format($kanji->strokes) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Data') ?></h4>
        <?= $this->Text->autoParagraph(h($kanji->data)); ?>
    </div>
</div>
