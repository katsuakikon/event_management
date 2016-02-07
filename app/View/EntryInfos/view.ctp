<div class="entryInfos view">
<h2><?php echo __('参加者詳細'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Event Info Id'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['event_info_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['status_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Event Date'); ?></dt>
		<dd>
			<?php echo h(date('Y年n月j日', strtotime($entryInfo['EntryInfo']['event_date']))); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Medical Instition No'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['medical_instition_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Participant No'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['participant_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Medical Instition'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['medical_instition']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Department'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['department']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Post'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['post']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tel No1'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['tel_no1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tel No2'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['tel_no2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fax'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['fax']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mail Address'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['mail_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Postal Code'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['postal_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Remarks'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['remarks']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Entry Info'), array('action' => 'edit', $entryInfo['EntryInfo']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Entry Info'), array('action' => 'delete', $entryInfo['EntryInfo']['id']), array(), __('Are you sure you want to delete # %s?', $entryInfo['EntryInfo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Entry Infos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Entry Info'), array('action' => 'add')); ?> </li>
	</ul>
</div>
