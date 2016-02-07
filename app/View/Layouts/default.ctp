<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html　lang="ja">
<head>
	<meta charset="utf-8">
    <title><?php echo $titleForLayout; ?></title>

	<?php echo $this->Html->script('lib/jquery-1.11.0.min'); ?>
    <?php echo $this->Html->script('lib/jquery.cookie'); ?>
    <?php echo $this->Html->script('cookie_config'); ?>

	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('hs');
		echo $this->Html->css('custom');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1>イベント管理システム</h1>
			<div style="width:100%">
			<?php echo $this->Html->link('管理TOP', '/', array('class' => 'pull-right')); ?>
		</div>
		</div>
		<div id="content">
			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
