<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Alike $alike
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Alike'), ['action' => 'edit', $alike->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Alike'), ['action' => 'delete', $alike->id], ['confirm' => __('Are you sure you want to delete # {0}?', $alike->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Alike'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Alike'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="alike view large-9 medium-8 columns content">
    <h3><?= h($alike->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($alike->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reference') ?></th>
            <td><?= $this->Number->format($alike->reference) ?></td>
        </tr>
    </table>
</div>
