<div class="entryInfos view">
<h2><?php echo __('参加者詳細'); ?></h2>
<div class="float-reset"></div>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('開催情報マスタNo'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['event_info_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('状態'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['status_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('イベント日時'); ?></dt>
		<dd>
			<?php echo h(date('Y年n月j日', strtotime($entryInfo['EntryInfo']['event_date']))); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('医療機関No.'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['medical_instition_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('参加者No.'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['participant_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('医療機関名'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['medical_instition']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('部署'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['department']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('役職'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['post']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('氏名'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('電話番号1'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['tel_no1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('電話番号2'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['tel_no2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('FAX'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['fax']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('メールアドレス'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['mail_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('郵便番号'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['postal_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('住所'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('備考'); ?></dt>
		<dd>
			<?php echo h($entryInfo['EntryInfo']['remarks']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('編集'), array('action' => 'edit', $entryInfo['EntryInfo']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $entryInfo['EntryInfo']['id']), array(), __('次のIDの参加者を本当に削除しますか # %s?', $entryInfo['EntryInfo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('一覧'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('新規作成'), array('action' => 'add')); ?> </li>
	</ul>
</div>
