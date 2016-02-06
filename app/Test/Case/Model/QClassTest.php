<?php
App::uses('QClass', 'Model');

/**
 * QClass Test Case
 *
 */
class QClassTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.q_class'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->QClass = ClassRegistry::init('QClass');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->QClass);

		parent::tearDown();
	}

}
