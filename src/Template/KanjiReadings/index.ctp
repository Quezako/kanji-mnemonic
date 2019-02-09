<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\KanjiReading[]|\Cake\Collection\CollectionInterface $kanjiReadings
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Kanji Reading'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="kanjiReadings index large-9 medium-8 columns content">
    <h3><?= __('Kanji Readings') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ucs') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('reading') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($kanjiReadings as $kanjiReading): ?>
            <tr>
                <td><?= $this->Number->format($kanjiReading->id) ?></td>
                <td><?= h($kanjiReading->ucs) ?></td>
                <td><?= h($kanjiReading->type) ?></td>
                <td><?= h($kanjiReading->reading) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $kanjiReading->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $kanjiReading->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $kanjiReading->id], ['confirm' => __('Are you sure you want to delete # {0}?', $kanjiReading->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
