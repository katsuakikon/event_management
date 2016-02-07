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
		if ($this->Session->read('event_info_id')) {
			$eventId = $this->Session->read('event_info_id');
			$this->EntryInfo->recursive = 0;
			$conditions = array('event_info_id' => $eventId);
			$this->set('entryInfos', $this->Paginator->paginate($conditions));
			$this->__setStatusBox(0);

			$eventData = $this->EventInfo->find('first', array(
					'conditions' => array(
						'EventInfo.id' => $eventId)
					)
				);
			$this->set('eventTitle', $eventData['EventInfo']['title']);

			$notCnt = $this->EntryInfo->find('count', array(
						'conditions' => array(
						'EntryInfo.event_info_id' => $eventId,
						'EntryInfo.status_id' => 0 
						)
					)
				);
			$allCnt = $this->EntryInfo->find('count', array(
						'conditions' => array(
						'EntryInfo.event_info_id' => $eventId
						)
					)
				);

			$this->set('allCnt', $allCnt);
			$this->set('inCnt', $allCnt - $notCnt);

		} else {
			$this->EntryInfo->recursive = 0;
			$this->set('entryInfos', $this->Paginator->paginate());
			$this->__setStatusBox(0);
		}
		
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
		$this->__setStatusBox(0);
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
				$this->Session->setFlash(__('登録しました'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('登録に失敗しました'));
			}
		}

		$this->set('eventInfos', $this->EventInfo->find('list',
				array(
					'fields' => array('id', 'title')
					)
				)
			);
		$this->set('selected_event_info', $this->Session->read('event_info_id'));

		$this->__setStatusBox(0);
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
				$this->Session->setFlash(__('更新しました'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('更新に失敗しました'));
			}
		} else {
			$options = array('conditions' => array('EntryInfo.' . $this->EntryInfo->primaryKey => $id));
			$this->request->data = $this->EntryInfo->find('first', $options);

			$this->__setStatusBox($this->request->data['EntryInfo']['status_id']);

			$this->set('eventInfos', $this->EventInfo->find('list',
				array(
					'fields' => array('id', 'title')
					)
				)
			);
			$this->set('selected_event_info', $this->Session->read('event_info_id'));
		}
	}

	public function updateByBarcode() {

		if ($this->Session->read('event_info_id')) {
			$barcode_id = $this->request->data['barcode'];

			$eventId = $this->Session->read('event_info_id');
			$entryData = $this->EntryInfo->find('first', array(
							'conditions' => array(
							'EntryInfo.event_info_id' => $eventId,
							'EntryInfo.id' => intval($barcode_id)
							)
						)
					);

			if (isset($entryData) && count($entryData) == 1) {

				if($entryData['EntryInfo']['status_id'] != 0) {
					$this->Session->setFlash(__('対象者はすでに受付済みです'));
					return $this->redirect(array('action' => 'index'));
				}

				$entryData['EntryInfo']['status_id'] = '1';

				if ($this->EntryInfo->save($entryData)) {
					$this->Session->setFlash(__($entryData['EntryInfo']['name'] . '様の受付をしました'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('更新に失敗しました'));
					return $this->redirect(array('action' => 'index'));
				}
				
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('対象者は参加者一覧に存在しません'));
				return $this->redirect(array('action' => 'index'));
			}
		} else {
			$this->Session->setFlash(__('イベントを指定し、参加者一覧から入力してください'));
			return $this->redirect(array('action' => 'index'));
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
			$this->Session->setFlash(__('削除しました'));
		} else {
			$this->Session->setFlash(__('削除に失敗しました'));
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

		$event_id = $this->Session->read('event_info_id');
		// ==================================

		$eventInfo = $this->EventInfo->find(
			'all',
			array('conditions' => array('EventInfo.id' => $event_id))
			);

		if (count($eventInfo) == 0) {
			$this->Session->setFlash(__('イベントデータがありません'));
			return;
		}

		$entryInfo = $this->EntryInfo->find(
			'all',
			array('conditions' => array('EntryInfo.event_info_id' => $event_id))
			);

		if (count($entryInfo) == 0) {
			$this->Session->setFlash(__('参加者情報がありません'));
			return;
		}


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

	public function __setStatusBox($status) {
		$this->set('statuses', array('未入場', '受付済', '代理受付'));
		$this->set('status_selected', $status);
	}
}
