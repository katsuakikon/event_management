<?php
/**
 * EntryInfoFixture
 *
 */
class EntryInfoFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'entry_info';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'event_info_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'status' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 1),
		'event_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'medical_instition_no' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 3),
		'participant_no' => array('type' => 'decimal', 'null' => false, 'default' => null),
		'barcode' => array('type' => 'decimal', 'null' => false, 'default' => null),
		'medical_instition' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100),
		'department' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100),
		'post' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100),
		'tel_no1' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20),
		'tel_no2' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20),
		'fax' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20),
		'mail_address' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 256),
		'postal_code' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10),
		'address' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100),
		'remarks' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100),
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
			'event_info_id' => 1,
			'status' => 'Lorem ipsum dolor sit ame',
			'event_date' => '2016-02-05 07:06:41',
			'medical_instition_no' => 'L',
			'participant_no' => '',
			'barcode' => '',
			'medical_instition' => 'Lorem ipsum dolor sit amet',
			'department' => 'Lorem ipsum dolor sit amet',
			'post' => 'Lorem ipsum dolor sit amet',
			'name' => 'Lorem ipsum dolor sit amet',
			'tel_no1' => 'Lorem ipsum dolor ',
			'tel_no2' => 'Lorem ipsum dolor ',
			'fax' => 'Lorem ipsum dolor ',
			'mail_address' => 'Lorem ipsum dolor sit amet',
			'postal_code' => 'Lorem ip',
			'address' => 'Lorem ipsum dolor sit amet',
			'remarks' => 'Lorem ipsum dolor sit amet'
		),
	);

}
