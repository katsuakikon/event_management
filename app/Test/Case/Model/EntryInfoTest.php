<?php
App::uses('EntryInfo', 'Model');

/**
 * EntryInfo Test Case
 *
 */
class EntryInfoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.entry_info'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->EntryInfo = ClassRegistry::init('EntryInfo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->EntryInfo);

		parent::tearDown();
	}

}
