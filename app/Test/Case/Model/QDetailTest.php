<?php
App::uses('QDetail', 'Model');

/**
 * QDetail Test Case
 *
 */
class QDetailTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.q_detail'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->QDetail = ClassRegistry::init('QDetail');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->QDetail);

		parent::tearDown();
	}

}
