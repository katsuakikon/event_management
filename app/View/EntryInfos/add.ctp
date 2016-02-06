<div class="entryInfos form">
<?php echo $this->Form->create('EntryInfo'); ?>
	<fieldset>
		<legend><?php echo __('Add Entry Info'); ?></legend>
	<?php
		echo $this->Form->input('event_info_id');
		echo $this->Form->input('status');
		echo $this->Form->input('event_date');
		echo $this->Form->input('medical_instition_no');
		echo $this->Form->input('participant_no');
		echo $this->Form->input('medical_instition');
		echo $this->Form->input('department');
		echo $this->Form->input('post');
		echo $this->Form->input('name');
		echo $this->Form->input('tel_no1');
		echo $this->Form->input('tel_no2');
		echo $this->Form->input('fax');
		echo $this->Form->input('mail_address');
		echo $this->Form->input('postal_code');
		echo $this->Form->input('address');
		echo $this->Form->input('remarks');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Entry Infos'), array('action' => 'index')); ?></li>
	</ul>
</div>
