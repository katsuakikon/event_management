<div class="entryInfos form">
<h2>参加者ファイルインポート(xlsx)</h2>
<div class="float-reset"></div>
<div class="normal_message">
取り込むファイルには事前に作成したイベントのIDを必ず付与してください
</div>
<!-- <?php echo $this->Form->create('EntryInfo'); ?> -->
<?php echo $this->Form->create(null, array('type' => 'file', 'url' => array('controller' => 'EntryInfos', 'action' => 'import'))); ?>
	<?php echo $this->Form->input('content', array('type' => 'file', 'label' => false, 'div' => false));?>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('参加者一覧'), array('action' => 'index')); ?></li>
	</ul>
</div>

<?php echo $this->Html->script('import_submit'); ?>
