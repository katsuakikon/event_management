<div class="eventInfos form">
<?php echo $this->Form->create('EventInfo'); ?>
	<fieldset>
		<legend><?php echo __('イベント新規作成'); ?></legend>
	<?php
		echo $this->Form->input('title', array('label' => 'タイトル'));
		echo $this->Form->input('main_text', array('label' => '概要（本文）'));
		echo $this->Form->input('event_place', array('label' => '開催場所'));
		echo $this->Form->input('phone_number', array('label' => '電話番号'));
		echo $this->Form->input('event_date', array('label' => '開催日時　（開始）'));
		echo $this->Form->input('event_end_date', array('label' => '開催日時　（終了）'));
		echo $this->Form->input('footer_main', array('label' => '追記（署名など）'));
		// echo $this->Form->input('footer_sub');
		echo $this->Form->input('published_date', array('label' => '告知日'));
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
