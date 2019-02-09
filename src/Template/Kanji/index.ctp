<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Kanji[]|\Cake\Collection\CollectionInterface $kanji
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Kanji'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="kanji index large-9 medium-8 columns content">
    <h3><?= __('Kanji') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ucs') ?></th>
                <th scope="col"><?= $this->Paginator->sort('kanji') ?></th>
                <th scope="col"><?= $this->Paginator->sort('jlpt') ?></th>
                <th scope="col"><?= $this->Paginator->sort('grade') ?></th>
                <th scope="col"><?= $this->Paginator->sort('strokes') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($kanji as $kanji): ?>
            <tr>
                <td><?= h($kanji->ucs) ?></td>
                <td><?= h($kanji->kanji) ?></td>
                <td><?= $this->Number->format($kanji->jlpt) ?></td>
                <td><?= $this->Number->format($kanji->grade) ?></td>
                <td><?= $this->Number->format($kanji->strokes) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $kanji->ucs]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $kanji->ucs]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $kanji->ucs], ['confirm' => __('Are you sure you want to delete # {0}?', $kanji->ucs)]) ?>
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
