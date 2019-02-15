<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Mnemonic $mnemonic
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Mnemonic'), ['action' => 'edit', $mnemonic->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Mnemonic'), ['action' => 'delete', $mnemonic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mnemonic->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Mnemonics'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mnemonic'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="mnemonics view large-9 medium-8 columns content">
    <h3><?= h($mnemonic->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Mnemonic') ?></th>
            <td><?= h($mnemonic->mnemonic) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reference') ?></th>
            <td><?= $this->Number->format($mnemonic->reference) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($mnemonic->id) ?></td>
        </tr>
    </table>
</div>
