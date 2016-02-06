<div class="eventInfos form">
<?php echo $this->Form->create('EventInfo'); ?>
	<fieldset>
		<legend><?php echo __('Add Event Info'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('main_text');
		echo $this->Form->input('event_place');
		echo $this->Form->input('phone_number');
		echo $this->Form->input('event_date');
		echo $this->Form->input('event_end_date');
		echo $this->Form->input('footer_main');
		echo $this->Form->input('footer_sub');
		echo $this->Form->input('published_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Event Infos'), array('action' => 'index')); ?></li>
	</ul>
</div>
