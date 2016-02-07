<section>
	<h1>管理メニュー</h1>
	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>
			<li>登録済みのイベント一覧を表示します</li>
			<li><?php echo $this->Html->link(__('イベント一覧表示'), array('controller' => 'EventInfos', 'action' => 'index')); ?> </li>
			<li>イベントを新規作成します</li>
			<li><?php echo $this->Html->link(__('イベント新規作成'), array('controller' => 'EventInfos', 'action' => 'add')); ?> </li>
			<li>※参加者の追加、編集は各イベントから行えます</li>
			<li>------------------------------</li>
			<li>エクセルファイルで参加者を一括取り込みします</li>
			<li><?php echo $this->Html->link(__('参加者ファイルインポート'), array('controller' => 'EntryInfos', 'action' => 'import')); ?> </li>
		</ul>
	</div>
</section>