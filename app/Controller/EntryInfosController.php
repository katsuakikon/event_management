<?php
App::uses('AppController', 'Controller');

App::import('Vendor', 'PHPExcel', array('file' => 'Classes' . DS . 'PHPExcel.php'));

App::import('Vendor', 'Barcode2', array('file' => 'Image' . DS . 'Barcode2.php'));
require APP . 'Vendor/autoload.php';


/**
 * EntryInfos Controller
 *
 * @property EntryInfo $EntryInfo
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class EntryInfosController extends AppController {

	public $uses = array(
		'EntryInfo',
		'EventInfo',
		);

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

	public function createPDF($event_id = null, $entry_array = null) {

		// ==================================
		
		// $data = $this->EntryInfo->getList();

		$event_id = '1';
		// ==================================

		$eventInfo = $this->EventInfo->find(
			'all',
			array('conditions' => array('EventInfo.id' => $event_id))
			);

		if (count($eventInfo) == 0) {
			throw new NotFoundException(__('イベントデータがありません'));
		}

		$entryInfo = $this->EntryInfo->find(
			'all',
			array('conditions' => array('EntryInfo.event_info_id' => $event_id))
			);

		$eventData = $eventInfo[0]['EventInfo'];
		$eventTime = date('Y年n月j日  G時i分 ～ ', strtotime($eventData['event_date']));
		$eventTime = $eventTime . date('G時i分', strtotime($eventData['event_end_date']));

		foreach ($entryInfo as $k => $v) {
			$userName = str_replace(' ', '', $v['EntryInfo']['name']);
			$userName = str_replace('　', '', $userName);
			$baseFileName = 'ENTRY_' . trim($v['EntryInfo']['medical_instition']) . '_' . trim($userName) . '様.pdf';
			$fileName = mb_convert_encoding($baseFileName, 'sjis-win', 'UTF-8');
			$barcode_id = str_pad($v['EntryInfo']['id'], 12, 0, STR_PAD_LEFT);
			$barcode_file = 'BC_' . $barcode_id . 'png';
			// バーコード作成
			$this->__createBarcord($barcode_id, $barcode_file);
			
			$report = new Thinreports\Report(FILE_TEMPLATE . 'event_guid_ja.tlf');

			// イベント情報
			$page = $report->addPage();
			$page->item('event_title')->setValue($eventData['title']);
			$page->item('main_text')->setValue($eventData['main_text']);
			$page->item('event_date')->setValue($eventTime);
			$page->item('event_place')->setValue($eventData['event_place']);
			$page->item('footer_main')->setValue($eventData['footer_main']);
			// 来場者情報
			$page->item('medical_instition')->setValue($v['EntryInfo']['medical_instition']);
			$page->item('department')->setValue($v['EntryInfo']['department']);
			$page->item('name')->setValue($v['EntryInfo']['name']);
			$page->item('tel_no1')->setValue($v['EntryInfo']['tel_no1']);
			$page->item('fax')->setValue($v['EntryInfo']['fax']);
			$page->item('mail_address')->setValue($v['EntryInfo']['mail_address']);

			$page->item('barcord')->setValue(FILE_BARCORD . $barcode_file);

			$report->generate(FILE_PDF . $fileName);
		}
	}

	public function __createBarcord($id = null, $fileName) {
		
		// draw引数
		// 1.バーコードデータ
		// 2.バーコードタイプ ( code39, int25, ean13, code128, postnet, ean8, upca, upce )
		// 3.画像形式 ( gif, jpg, png )
		// 4.画像出力 ( true, false )
		// 5.高さ ( デフォルト 60 )
		// 6.幅 ( デフォルト 1, 全体の幅ではないので注意 )
		// 7.バーコードの値を表示するか ( true, false )
		// 8.回転

		$code = new Image_Barcode2();
		$image = $code->draw($id, 'code128', 'png', false);
		// $this->set('test', base64_encode($image));
		imagepng($image, FILE_BARCORD . $fileName);

	}
}
