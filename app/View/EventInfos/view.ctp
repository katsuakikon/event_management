<div class="eventInfos view">
<h2><?php echo __('Event Info'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($eventInfo['EventInfo']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($eventInfo['EventInfo']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Main Text'); ?></dt>
		<dd>
			<?php echo h($eventInfo['EventInfo']['main_text']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Event Place'); ?></dt>
		<dd>
			<?php echo h($eventInfo['EventInfo']['event_place']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone Number'); ?></dt>
		<dd>
			<?php echo h($eventInfo['EventInfo']['phone_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Event Date'); ?></dt>
		<dd>
			<?php echo h($eventInfo['EventInfo']['event_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Event End Date'); ?></dt>
		<dd>
			<?php echo h($eventInfo['EventInfo']['event_end_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Footer Main'); ?></dt>
		<dd>
			<?php echo h($eventInfo['EventInfo']['footer_main']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Footer Sub'); ?></dt>
		<dd>
			<?php echo h($eventInfo['EventInfo']['footer_sub']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Published Date'); ?></dt>
		<dd>
			<?php echo h($eventInfo['EventInfo']['published_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Event Info'), array('action' => 'edit', $eventInfo['EventInfo']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Event Info'), array('action' => 'delete', $eventInfo['EventInfo']['id']), array(), __('Are you sure you want to delete # %s?', $eventInfo['EventInfo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Event Infos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event Info'), array('action' => 'add')); ?> </li>
	</ul>
</div>
