<?php
App::uses('QBase', 'Model');

/**
 * QBase Test Case
 *
 */
class QBaseTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.q_base'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->QBase = ClassRegistry::init('QBase');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->QBase);

		parent::tearDown();
	}

}
