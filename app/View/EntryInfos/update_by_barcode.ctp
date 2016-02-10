<h2><?php echo $eventTitle . __(' 参加者バーコード読み取り画面'); ?></h2>
<div class='entryCount'>
	<span>来場者数：&nbsp;<?php echo $inCnt; ?>&nbsp;/&nbsp;<?php echo $allCnt; ?></span>
</div>
<div class="float-reset"></div>
<div>
	<div class='barcodeDescription'>
		カーソルを当てた状態でバーコードを読み取ってください⇒<br>
		※半角入力にしてください。<br>
		全角で入力した場合はEnterキーを押してください。
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
		<input type="text" name="barcode" class="fm">
		</form>
	</div>
</div>
<div class="float-reset"></div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('一覧'), array('action' => 'index')); ?> </li>
	</ul>
</div>

<?php echo $this->Html->script('change_input'); ?>