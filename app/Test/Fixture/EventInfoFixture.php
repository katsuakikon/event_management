<?php
/**
 * EventInfoFixture
 *
 */
class EventInfoFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'event_info';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 1000),
		'main_text' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 2000),
		'event_place' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200),
		'phone_number' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20),
		'event_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'event_end_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'footer_main' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 2000),
		'footer_sub' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 2000),
		'published_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'main_text' => 'Lorem ipsum dolor sit amet',
			'event_place' => 'Lorem ipsum dolor sit amet',
			'phone_number' => 'Lorem ipsum dolor ',
			'event_date' => '2016-02-05 06:18:06',
			'event_end_date' => '2016-02-05 06:18:06',
			'footer_main' => 'Lorem ipsum dolor sit amet',
			'footer_sub' => 'Lorem ipsum dolor sit amet',
			'published_date' => '2016-02-05 06:18:06'
		),
	);

}
