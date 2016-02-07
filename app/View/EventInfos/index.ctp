<div class="eventInfos index">
	<h2><?php echo __('イベント一覧'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('title', 'タイトル'); ?></th>
			<th><?php echo $this->Paginator->sort('main_text', '概要'); ?></th>
			<th><?php echo $this->Paginator->sort('event_place', '会場'); ?></th>
			<th><?php echo $this->Paginator->sort('phone_number', '電話番号'); ?></th>
			<th><?php echo $this->Paginator->sort('event_date', '開始時刻'); ?></th>
			<th><?php echo $this->Paginator->sort('event_end_date', '終了時刻'); ?></th>
			<!-- <th><?php echo $this->Paginator->sort('footer_main'); ?></th> -->
			<!-- <th><?php echo $this->Paginator->sort('footer_sub'); ?></th> -->
			<!-- <th><?php echo $this->Paginator->sort('published_date'); ?></th> -->
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($eventInfos as $eventInfo): ?>
	<tr>
		<td><?php echo h($eventInfo['EventInfo']['id']); ?>&nbsp;</td>
		<td><?php echo h($eventInfo['EventInfo']['title']); ?>&nbsp;</td>
		<td><?php echo h($eventInfo['EventInfo']['main_text']); ?>&nbsp;</td>
		<td><?php echo h($eventInfo['EventInfo']['event_place']); ?>&nbsp;</td>
		<td><?php echo h($eventInfo['EventInfo']['phone_number']); ?>&nbsp;</td>
		<td><?php echo h(date('Y年n月j日　G時i分', strtotime($eventInfo['EventInfo']['event_date']))); ?>&nbsp;</td>
		<td><?php echo h(date('Y年n月j日　G時i分', strtotime($eventInfo['EventInfo']['event_end_date']))); ?>&nbsp;</td>
		<!-- <td><?php echo h($eventInfo['EventInfo']['footer_main']); ?>&nbsp;</td> -->
		<!-- <td><?php echo h($eventInfo['EventInfo']['footer_sub']); ?>&nbsp;</td> -->
		<!-- <td><?php echo h($eventInfo['EventInfo']['published_date']); ?>&nbsp;</td> -->
		<td class="actions">
			<div class='c-list'>
				<div>
			<?php echo $this->Html->link(__('詳細'), array('action' => 'view', $eventInfo['EventInfo']['id'])); ?>
			<?php echo $this->Html->link(__('編集'), array('action' => 'edit', $eventInfo['EventInfo']['id'])); ?>
				</div>
			<?php echo $this->Form->create(null, array(
					'url' => array('action' => 'viewEntry'),
					'class' => 'list-form',
					'inputDefaults' => array(
						'div' => false)
					)
				);
			?>
			<input type="hidden" name="event_info_id" value="<?php echo $eventInfo['EventInfo']['id']; ?>">
			<?php echo $this->Form->end(__('参加者一覧'), array(
							'div' => false)
						);
			?>
			</div>
<!-- 			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $eventInfo['EventInfo']['id']), array(), __('Are you sure you want to delete # %s?', $eventInfo['EventInfo']['id'])); ?> -->
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
		<li><?php echo $this->Html->link(__('イベント新規作成'), array('action' => 'add')); ?></li>
	</ul>
</div>
