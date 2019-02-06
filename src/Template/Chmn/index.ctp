<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Chmn[]|\Cake\Collection\CollectionInterface $chmn
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Chmn'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="chmn index large-9 medium-8 columns content">
    <h3><?= __('Chmn') ?></h3>
	<?= $this->Form->create("", ['type'=>'get']) ?>
	<?= $this->Form->control('hanzi'); ?>
	<button>Search</button>
	<?= $this->Form->end() ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hanzi') ?></th>
                <th scope="col"><?= $this->Paginator->sort('simplified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mnemonics') ?></th>
                <th scope="col"><?= $this->Paginator->sort('alike') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mine') ?></th>
                <th scope="col"><?= $this->Paginator->sort('meaning') ?></th>
                <th scope="col"><?= $this->Paginator->sort('reference') ?></th>
                <th scope="col"><?= $this->Paginator->sort('remnant') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($chmn as $chmn): ?>
            <tr>
                <td><?= $this->Number->format($chmn->id) ?></td>
                <td><?= h($chmn->number) ?></td>
                <td><?= h($chmn->hanzi) ?></td>
                <td><?= h($chmn->simplified) ?></td>
                <td><?= h($chmn->mnemonics) ?></td>
                <td><?= h($chmn->alike) ?></td>
                <td><?= h($chmn->mine) ?></td>
                <td><?= h($chmn->meaning) ?></td>
                <td><?= h($chmn->reference) ?></td>
                <td><?= h($chmn->remnant) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $chmn->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $chmn->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $chmn->id], ['confirm' => __('Are you sure you want to delete # {0}?', $chmn->id)]) ?>
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
