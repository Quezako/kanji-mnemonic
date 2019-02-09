<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\KanjiMeaning[]|\Cake\Collection\CollectionInterface $kanjiMeanings
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Kanji Meaning'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="kanjiMeanings index large-9 medium-8 columns content">
    <h3><?= __('Kanji Meanings') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ucs') ?></th>
                <th scope="col"><?= $this->Paginator->sort('language') ?></th>
                <th scope="col"><?= $this->Paginator->sort('meaning') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($kanjiMeanings as $kanjiMeaning): ?>
            <tr>
                <td><?= $this->Number->format($kanjiMeaning->id) ?></td>
                <td><?= h($kanjiMeaning->ucs) ?></td>
                <td><?= h($kanjiMeaning->language) ?></td>
                <td><?= h($kanjiMeaning->meaning) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $kanjiMeaning->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $kanjiMeaning->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $kanjiMeaning->id], ['confirm' => __('Are you sure you want to delete # {0}?', $kanjiMeaning->id)]) ?>
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
