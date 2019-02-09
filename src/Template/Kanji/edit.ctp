<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Kanji $kanji
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $kanji->ucs],
                ['confirm' => __('Are you sure you want to delete # {0}?', $kanji->ucs)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Kanji'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="kanji form large-9 medium-8 columns content">
    <?= $this->Form->create($kanji) ?>
    <fieldset>
        <legend><?= __('Edit Kanji') ?></legend>
        <?php
            echo $this->Form->control('kanji');
            echo $this->Form->control('jlpt');
            echo $this->Form->control('grade');
            echo $this->Form->control('strokes');
            echo $this->Form->control('data');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
