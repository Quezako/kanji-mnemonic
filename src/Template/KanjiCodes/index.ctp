<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\KanjiCode[]|\Cake\Collection\CollectionInterface $kanjiCodes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Kanji Code'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="kanjiCodes index large-9 medium-8 columns content">
    <h3><?= __('Kanji Codes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ucs') ?></th>
                <th scope="col"><?= $this->Paginator->sort('section') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('value') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($kanjiCodes as $kanjiCode): ?>
            <tr>
                <td><?= $this->Number->format($kanjiCode->id) ?></td>
                <td><?= h($kanjiCode->ucs) ?></td>
                <td><?= h($kanjiCode->section) ?></td>
                <td><?= h($kanjiCode->type) ?></td>
                <td><?= h($kanjiCode->value) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $kanjiCode->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $kanjiCode->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $kanjiCode->id], ['confirm' => __('Are you sure you want to delete # {0}?', $kanjiCode->id)]) ?>
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
