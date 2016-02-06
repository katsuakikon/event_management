<?php
App::uses('AppController', 'Controller');

class AdminController extends AppController {

	public function isAuthorized($user) {
		if (isset($user['role']) && $user['role'] === 'admin') {
			return true;
		}
		// デフォルトは拒否
		return false;
	}

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

	public function index() {
	}
}
