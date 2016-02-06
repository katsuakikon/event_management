<div class="entryInfos form">
<!-- <?php echo $this->Form->create('EntryInfo'); ?> -->
<?php echo $this->Form->create(null, array('type' => 'file', 'url' => array('controller' => 'EntryInfos', 'action' => 'import'))); ?>
	<?php echo $this->Form->input('content', array('type' => 'file', 'label' => false, 'div' => false));?>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Entry Infos'), array('action' => 'index')); ?></li>
	</ul>
</div>
