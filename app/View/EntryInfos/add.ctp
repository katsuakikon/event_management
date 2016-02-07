<div class="entryInfos form">
<?php echo $this->Form->create('EntryInfo'); ?>
	<fieldset>
		<legend><?php echo __('Add Entry Info'); ?></legend>
	<?php
		echo $this->Form->input('event_info_id', array(
			'label' => 'イベントタイトル',
       		'selected'=>$selected_event_info,
       		'required' => true,
            'div' => true,
       		)
		);
		echo $this->Form->input('status_id', array(
			'label' => '状態',
       		'selected'=>$status_selected,
       		'required' => true,
            'div' => true,
       		)
		);
		echo $this->Form->input('event_date', array('label' => 'イベント日時'));
		echo $this->Form->input('medical_instition_no', array('label' => '医療機関No'));
		echo $this->Form->input('participant_no', array('label' => '参加者No'));
		echo $this->Form->input('medical_instition', array('label' => '医療機関名'));
		echo $this->Form->input('department', array('label' => '部署'));
		echo $this->Form->input('post', array('label' => '役職'));
		echo $this->Form->input('name', array('label' => '氏名'));
		echo $this->Form->input('tel_no1', array('label' => '電話番号1'));
		echo $this->Form->input('tel_no2', array('label' => '電話番号2'));
		echo $this->Form->input('fax', array('label' => 'FAX'));
		echo $this->Form->input('mail_address', array('label' => 'メールアドレス'));
		echo $this->Form->input('postal_code', array('label' => '郵便番号'));
		echo $this->Form->input('address', array('label' => '住所'));
		echo $this->Form->input('remarks', array('label' => '備考'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('一覧'), array('action' => 'index')); ?></li>
	</ul>
</div>
