<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Alike[]|\Cake\Collection\CollectionInterface $alike
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Alike'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="alike index large-9 medium-8 columns content">
    <h3><?= __('Alike') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('reference') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hanzi') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alike as $alike): ?>
            <tr>
                <td><?= $this->Number->format($alike->id) ?></td>
                <td><?= $this->Number->format($alike->reference) ?></td>
                <td><?= h($alike->hanzi) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $alike->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $alike->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $alike->id], ['confirm' => __('Are you sure you want to delete # {0}?', $alike->id)]) ?>
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
