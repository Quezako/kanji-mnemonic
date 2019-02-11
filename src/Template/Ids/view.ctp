<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Id $id
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Id'), ['action' => 'edit', $id->ucs]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Id'), ['action' => 'delete', $id->ucs], ['confirm' => __('Are you sure you want to delete # {0}?', $id->ucs)]) ?> </li>
        <li><?= $this->Html->link(__('List Ids'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Id'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="ids view large-9 medium-8 columns content">
    <h3><?= h($id->ucs) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Ucs') ?></th>
            <td><?= h($id->ucs) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ids') ?></th>
            <td><?= h($id->ids) ?></td>
        </tr>
    </table>
</div>
