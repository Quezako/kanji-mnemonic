<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Chmn $chmn
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Chmn'), ['action' => 'edit', $chmn->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Chmn'), ['action' => 'delete', $chmn->id], ['confirm' => __('Are you sure you want to delete # {0}?', $chmn->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Chmn'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Chmn'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="chmn view large-9 medium-8 columns content">
    <h3><?= h($chmn->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Number') ?></th>
            <td><?= h($chmn->number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hanzi') ?></th>
            <td><?= h($chmn->hanzi) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Simplified') ?></th>
            <td><?= h($chmn->simplified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mnemonics') ?></th>
            <td><?= h($chmn->mnemonics) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Alike') ?></th>
            <td><?= h($chmn->alike) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Meaning') ?></th>
            <td><?= h($chmn->meaning) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reference') ?></th>
            <td><?= h($chmn->reference) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($chmn->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mine') ?></th>
            <td><?= $chmn->mine ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Remnant') ?></th>
            <td><?= $chmn->remnant ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
