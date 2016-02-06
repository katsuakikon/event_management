<div class="entryInfos index">
	<h2><?php echo __('Entry Infos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('event_info_id'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('event_date'); ?></th>
			<th><?php echo $this->Paginator->sort('medical_instition_no'); ?></th>
			<th><?php echo $this->Paginator->sort('participant_no'); ?></th>
			<th><?php echo $this->Paginator->sort('barcode'); ?></th>
			<th><?php echo $this->Paginator->sort('medical_instition'); ?></th>
			<th><?php echo $this->Paginator->sort('department'); ?></th>
			<th><?php echo $this->Paginator->sort('post'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('tel_no1'); ?></th>
			<th><?php echo $this->Paginator->sort('tel_no2'); ?></th>
			<th><?php echo $this->Paginator->sort('fax'); ?></th>
			<th><?php echo $this->Paginator->sort('mail_address'); ?></th>
			<th><?php echo $this->Paginator->sort('postal_code'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('remarks'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($entryInfos as $entryInfo): ?>
	<tr>
		<td><?php echo h($entryInfo['EntryInfo']['id']); ?>&nbsp;</td>
		<td><?php echo h($entryInfo['EntryInfo']['event_info_id']); ?>&nbsp;</td>
		<td><?php echo h($entryInfo['EntryInfo']['status']); ?>&nbsp;</td>
		<td><?php echo h($entryInfo['EntryInfo']['event_date']); ?>&nbsp;</td>
		<td><?php echo h($entryInfo['EntryInfo']['medical_instition_no']); ?>&nbsp;</td>
		<td><?php echo h($entryInfo['EntryInfo']['participant_no']); ?>&nbsp;</td>
		<td><?php echo h($entryInfo['EntryInfo']['medical_instition']); ?>&nbsp;</td>
		<td><?php echo h($entryInfo['EntryInfo']['department']); ?>&nbsp;</td>
		<td><?php echo h($entryInfo['EntryInfo']['post']); ?>&nbsp;</td>
		<td><?php echo h($entryInfo['EntryInfo']['name']); ?>&nbsp;</td>
		<td><?php echo h($entryInfo['EntryInfo']['tel_no1']); ?>&nbsp;</td>
		<td><?php echo h($entryInfo['EntryInfo']['tel_no2']); ?>&nbsp;</td>
		<td><?php echo h($entryInfo['EntryInfo']['fax']); ?>&nbsp;</td>
		<td><?php echo h($entryInfo['EntryInfo']['mail_address']); ?>&nbsp;</td>
		<td><?php echo h($entryInfo['EntryInfo']['postal_code']); ?>&nbsp;</td>
		<td><?php echo h($entryInfo['EntryInfo']['address']); ?>&nbsp;</td>
		<td><?php echo h($entryInfo['EntryInfo']['remarks']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $entryInfo['EntryInfo']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $entryInfo['EntryInfo']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $entryInfo['EntryInfo']['id']), array(), __('Are you sure you want to delete # %s?', $entryInfo['EntryInfo']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Entry Info'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('ファイルインポート'), array('action' => 'import')); ?></li>
	</ul>
</div>
