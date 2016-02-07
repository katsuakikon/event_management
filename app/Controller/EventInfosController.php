<?php
App::uses('AppController', 'Controller');
/**
 * EventInfos Controller
 *
 * @property EventInfo $EventInfo
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class EventInfosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->EventInfo->recursive = 0;
		$this->set('eventInfos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->EventInfo->exists($id)) {
			throw new NotFoundException(__('Invalid event info'));
		}
		$options = array('conditions' => array('EventInfo.' . $this->EventInfo->primaryKey => $id));
		$this->set('eventInfo', $this->EventInfo->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->EventInfo->create();
			if ($this->EventInfo->save($this->request->data)) {
				$this->Session->setFlash(__('The event info has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event info could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->EventInfo->exists($id)) {
			throw new NotFoundException(__('Invalid event info'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->EventInfo->save($this->request->data)) {
				$this->Session->setFlash(__('The event info has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event info could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('EventInfo.' . $this->EventInfo->primaryKey => $id));
			$this->request->data = $this->EventInfo->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->EventInfo->id = $id;
		if (!$this->EventInfo->exists()) {
			throw new NotFoundException(__('Invalid event info'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->EventInfo->delete()) {
			$this->Session->setFlash(__('The event info has been deleted.'));
		} else {
			$this->Session->setFlash(__('The event info could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function viewEntry() {
		$this->Session->write('event_info_id', $this->request->data['event_info_id']);
		return $this->redirect(array('controller' => 'EntryInfos', 'action' => 'index'));
	}
}
