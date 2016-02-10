<?php
App::uses('AppModel', 'Model');
App::import('Vendor', 'PHPExcel', array('file' => 'Classes' . DS . 'PHPExcel.php'));
/**
 * EntryInfo Model
 *
 */
class EntryInfo extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'local';

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'entry_info';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'event_info_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'status_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	public function insertData($data) {

 // EVENT_INFO_ID serial NOT NULL,
 // STATUS CHAR(1) DEFAULT '0' NOT NULL,
 // EVENT_DATE TIMESTAMP,
 // MEDICAL_INSTITION_NO CHAR(3),
 // PARTICIPANT_NO NUMERIC(2,0) NOT NULL,
 // BARCODE NUMERIC(9,0) NOT NULL,
 // MEDICAL_INSTITION VARCHAR(100),
 // DEPARTMENT VARCHAR(100),
 // POST VARCHAR(100),
 // NAME VARCHAR(100),
 // TEL_NO1 VARCHAR(20),
 // TEL_NO2 VARCHAR(20),
 // FAX VARCHAR(20),
 // MAIL_ADDRESS VARCHAR(256),
 // POSTAL_CODE VARCHAR(10),
 // ADDRESS VARCHAR(100),
 // REMARKS VARCHAR(100)

		$columns = array(
			'event_info_id',
			'event_date',
			'medical_instition_no',
			'medical_instition',
			'participant_no',
			'department',
			'post',
			'name',
			'tel_no1',
			'tel_no2',
			'mail_address',
			'postal_code',
			'address',
			'remarks'
			);

		foreach ($data as $k1 => $v1) {
			// 先頭行はヘッダのため除く
			if ($k1 < 4) {
				continue;
			}
			$newData = null;
			$this->create();

			if (!isset($v1[0]) || $v1[0] == '') {
				break;
			}
			foreach ($v1 as $k2 => $v2) {
				if ($k2 >= 14) {
					continue;
				}
				
				if('event_info_id' === $columns[$k2]) {
					$newData[$columns[$k2]] = intval($v2);
				} else if('event_date' === $columns[$k2]) {
					$display_date = PHPExcel_Style_NumberFormat::toFormattedString($v2, PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);
					// $newData[$columns[$k2]] = date('Y-M-D', $display_date);
					$newData[$columns[$k2]] = $display_date;
				} else {
					// $newData[$columns[$k2]] = mb_convert_encoding($v2, "UTF-8", "SJIS");
					$newData[$columns[$k2]] = $v2;
				}
			}

			$this->save($newData);
		}
	}
}
