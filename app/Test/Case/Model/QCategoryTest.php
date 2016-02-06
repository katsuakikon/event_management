<?php
App::uses('QCategory', 'Model');

/**
 * QCategory Test Case
 *
 */
class QCategoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.q_category'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->QCategory = ClassRegistry::init('QCategory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->QCategory);

		parent::tearDown();
	}

}
