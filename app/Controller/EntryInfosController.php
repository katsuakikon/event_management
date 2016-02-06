<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'PHPExcel', array('file' => 'Classes' . DS . 'PHPExcel.php'));
/**
 * EntryInfos Controller
 *
 * @property EntryInfo $EntryInfo
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class EntryInfosController extends AppController {

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
		$this->EntryInfo->recursive = 0;
		$this->set('entryInfos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->EntryInfo->exists($id)) {
			throw new NotFoundException(__('Invalid entry info'));
		}
		$options = array('conditions' => array('EntryInfo.' . $this->EntryInfo->primaryKey => $id));
		$this->set('entryInfo', $this->EntryInfo->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->EntryInfo->create();
			if ($this->EntryInfo->save($this->request->data)) {
				$this->Session->setFlash(__('The entry info has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The entry info could not be saved. Please, try again.'));
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
		if (!$this->EntryInfo->exists($id)) {
			throw new NotFoundException(__('Invalid entry info'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->EntryInfo->save($this->request->data)) {
				$this->Session->setFlash(__('The entry info has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The entry info could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('EntryInfo.' . $this->EntryInfo->primaryKey => $id));
			$this->request->data = $this->EntryInfo->find('first', $options);
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
		$this->EntryInfo->id = $id;
		if (!$this->EntryInfo->exists()) {
			throw new NotFoundException(__('Invalid entry info'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->EntryInfo->delete()) {
			$this->Session->setFlash(__('The entry info has been deleted.'));
		} else {
			$this->Session->setFlash(__('The entry info could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * add method
 *
 * @return void
 */
	public function import() {
		// GETは処理しない
		if ($this->request->is('post')) {
			$this->__fileImport($this->request->data['EntryInfo']['content']);

			// // 新規データセットをDataManagerに登録する
			// $this->DataManager->create();
			// if ($this->DataManager->save($this->request->data['DataManager'])) {
			// 	// 登録が成功した場合はアップロードしたファイルから子テーブルの作成を実行する
			// 	$this->__fileImport($this->request->data['DataTable']['content'], $this->DataManager->id);

			// 	// 登録完了後のメッセージをセットする
			// 	$this->Session->setFlash(__('The data manager has been saved.'));
			// 	// 登録完了後の遷移先ページを設定する
			// 	return $this->redirect(array('action' => 'index'));
			// } else {
			// 	$this->Session->setFlash(__('The data manager could not be saved. Please, try again.'));
			// }
		}
		$this->set('titleForLayout', 'エクセルインポート');
	}

	private function __fileImport($fileData) {
		// ファイル種別の判定

		// TODO:メソッド化
		// excel読込
		$xlsReader = PHPExcel_IOFactory::createReader('Excel2007');
		$xlsObject = $xlsReader->load($fileData['tmp_name']);

		$data;

		// 対象は1シート目のみとする
		$xlsObject->setActiveSheetIndex(0);
		$xlsSheet = $xlsObject->getActiveSheet();
		$j = 0;
		foreach ($xlsSheet->getRowIterator() as $row) {
			$xlsCell = $row->getCellIterator();
			$xlsCell->setIterateOnlyExistingCells(false);
			$k = 0;
			foreach ($xlsCell as $cell) {
				// 「行番号・セル番号」の連想配列にセル内のデータを格納
				$data[$j][$k] = $cell->getValue();
				$k++;
			}
			$j++;
		}

		// var_dump($data);
		// $date = date('Y-m-d H:i:s', ($data[0][3] - 25569) * 60 * 60 * 24);
//****** 日付変換参考
		// $display_date = PHPExcel_Style_NumberFormat::toFormattedString($data[0][3], PHPExcel_Style_NumberFormat::FORMAT);

		// var_dump($display_date);
		// データ登録処理
		$this->EntryInfo->insertData($data);
	}
}
