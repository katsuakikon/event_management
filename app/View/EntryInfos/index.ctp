<div class="entryInfos index">
	<div>
		<div class='barcodeDescription'>
			カーソルを当てた状態でバーコードを読み取ってください⇒
		</div>
		<div class='barcodeForm'>
			<?php echo $this->Form->create(null, array(
					'class' => '',
					'url' => array('action' => 'updateByBarcode'),
					'inputDefaults' => array(
						'div' => false)
					)
				);
			?>
			<input type="text" name="barcode">
			</form>
		</div>
	</div>
	<div class="float-reset"></div>
	<h2><?php echo $eventTitle . __(' 参加者一覧'); ?></h2>
	<div class="actions list-update">
		<?php echo $this->Html->link(__('更新'), array('action' => 'index')); ?>
	</div>
	<div class='entryCount'>
		<span>来場者数：&nbsp;<?php echo $inCnt; ?>&nbsp;/&nbsp;<?php echo $allCnt; ?></span>
	</div>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<!-- <th><?php echo $this->Paginator->sort('event_info_id'); ?></th> -->
			<th><?php echo $this->Paginator->sort('status_id', '状態'); ?></th>
			<th><?php echo $this->Paginator->sort('event_date', '参加日'); ?></th>
			<!-- <th><?php echo $this->Paginator->sort('medical_instition_no'); ?></th> -->
			<!-- <th><?php echo $this->Paginator->sort('participant_no'); ?></th> -->
			<th><?php echo $this->Paginator->sort('medical_instition', '医療機関名'); ?></th>
			<th><?php echo $this->Paginator->sort('department', '部署'); ?></th>
			<th><?php echo $this->Paginator->sort('post', '役職'); ?></th>
			<th><?php echo $this->Paginator->sort('name', '名前'); ?></th>
			<th><?php echo $this->Paginator->sort('tel_no1', '電話番号'); ?></th>
			<!-- <th><?php echo $this->Paginator->sort('tel_no2'); ?></th> -->
			<!-- <th><?php echo $this->Paginator->sort('fax'); ?></th> -->
			<!-- <th><?php echo $this->Paginator->sort('mail_address'); ?></th> -->
			<!-- <th><?php echo $this->Paginator->sort('postal_code'); ?></th> -->
			<!-- <th><?php echo $this->Paginator->sort('address'); ?></th> -->
			<th><?php echo $this->Paginator->sort('remarks', '備考'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($entryInfos as $entryInfo): ?>
	<tr>
		<td><?php echo h($entryInfo['EntryInfo']['id']); ?>&nbsp;</td>
		<!-- <td><?php echo h($entryInfo['EntryInfo']['event_info_id']); ?>&nbsp;</td> -->
		<td>
			<?php echo h($statuses[$entryInfo['EntryInfo']['status_id']]); ?>&nbsp;
		</td>
		<td><?php echo h(date('Y年n月j日', strtotime($entryInfo['EntryInfo']['event_date']))); ?>&nbsp;</td>
		<!-- <td><?php echo h($entryInfo['EntryInfo']['medical_instition_no']); ?>&nbsp;</td> -->
		<!-- <td><?php echo h($entryInfo['EntryInfo']['participant_no']); ?>&nbsp;</td> -->
		<td><?php echo h($entryInfo['EntryInfo']['medical_instition']); ?>&nbsp;</td>
		<td><?php echo h($entryInfo['EntryInfo']['department']); ?>&nbsp;</td>
		<td><?php echo h($entryInfo['EntryInfo']['post']); ?>&nbsp;</td>
		<td><?php echo h($entryInfo['EntryInfo']['name']); ?>&nbsp;</td>
		<td><?php echo h($entryInfo['EntryInfo']['tel_no1']); ?>&nbsp;</td>
		<!-- <td><?php echo h($entryInfo['EntryInfo']['tel_no2']); ?>&nbsp;</td> -->
		<!-- <td><?php echo h($entryInfo['EntryInfo']['fax']); ?>&nbsp;</td> -->
		<!-- <td><?php echo h($entryInfo['EntryInfo']['mail_address']); ?>&nbsp;</td> -->
		<!-- <td><?php echo h($entryInfo['EntryInfo']['postal_code']); ?>&nbsp;</td> -->
		<!-- <td><?php echo h($entryInfo['EntryInfo']['address']); ?>&nbsp;</td> -->
		<td><?php echo h($entryInfo['EntryInfo']['remarks']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('詳細'), array('action' => 'view', $entryInfo['EntryInfo']['id'])); ?>
			<?php echo $this->Html->link(__('編集'), array('action' => 'edit', $entryInfo['EntryInfo']['id'])); ?>
<!-- 			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $entryInfo['EntryInfo']['id']), array(), __('Are you sure you want to delete # %s?', $entryInfo['EntryInfo']['id'])); ?> -->
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
		<li><?php echo $this->Html->link(__('新規追加'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('参加者ファイルインポート'), array('action' => 'import')); ?></li>
	</ul>
	<?php echo $this->Form->create(null, array(
			'class' => 'pdf-form',
			'url' => array('action' => 'createPDF'),
			'inputDefaults' => array(
				'div' => false)
			)
		);
	?>
	<input type="hidden" name="check_list" value="">
	<?php echo $this->Form->end(__('PDF出力'), array(
					'div' => false)
				);
	?>
</div>
