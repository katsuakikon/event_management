<div class="eventInfos view">
<h2><?php echo __('イベント詳細'); ?></h2>
<div class="float-reset"></div>
<div class="detail_dl">
	<dl>
		<dt><?php echo __('イベントID'); ?></dt>
		<dd>
			<?php echo h($eventInfo['EventInfo']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('タイトル'); ?></dt>
		<dd>
			<?php echo h($eventInfo['EventInfo']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('概要（本文）'); ?></dt>
		<dd>
			<?php echo h($eventInfo['EventInfo']['main_text']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('開催場所'); ?></dt>
		<dd>
			<?php echo h($eventInfo['EventInfo']['event_place']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('電話番号'); ?></dt>
		<dd>
			<?php echo h($eventInfo['EventInfo']['phone_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('開催日時　（開始）'); ?></dt>
		<dd>
			<?php echo h($eventInfo['EventInfo']['event_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('開催日時　（終了）'); ?></dt>
		<dd>
			<?php echo h($eventInfo['EventInfo']['event_end_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('追記（署名など）'); ?></dt>
		<dd>
			<?php echo h($eventInfo['EventInfo']['footer_main']); ?>
			&nbsp;
		</dd>
<!-- 		<dt><?php echo __('Footer Sub'); ?></dt>
		<dd>
			<?php echo h($eventInfo['EventInfo']['footer_sub']); ?>
			&nbsp;
		</dd> -->
		<dt><?php echo __('告知日'); ?></dt>
		<dd>
			<?php echo h($eventInfo['EventInfo']['published_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('編集'), array('action' => 'edit', $eventInfo['EventInfo']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $eventInfo['EventInfo']['id']), array(), __('次のIDのイベントを本当に削除しますか # %s?', $eventInfo['EventInfo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('一覧'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('新規作成'), array('action' => 'add')); ?> </li>
	</ul>
</div>
