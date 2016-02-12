<?php
App::uses('AppController', 'Controller');

App::import('Vendor', 'PHPExcel', array('file' => 'Classes' . DS . 'PHPExcel.php'));
App::import( 'Vendor', 'PHPExcel_IOFactory', array('file'=>'Classes' . DS . 'PHPExcel' . DS . 'IOFactory.php') );
App::import( 'Vendor', 'PHPExcel_Cell_AdvancedValueBinder', array('file'=>'Classes' . DS . 'PHPExcel' . DS . 'Cell' . DS . 'AdvancedValueBinder.php') );

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
		$this->set('titleForLayout', '参加者一覧');
		$this->Paginator->settings = array(
				'limit' => 300,
				'order' => array('EntryInfo.status_id' => 'asc', 'EntryInfo.id' => 'asc')
				);
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
			$this->Session->setFlash(__('イベントが選択されていません。管理TOPから入りなおしてください。'));
			$this->EntryInfo->recursive = 0;
			$this->set('entryInfos', $this->Paginator->paginate());
			$this->__setStatusBox(0);
			$this->set('allCnt', 0);
			$this->set('inCnt', 0);
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
		$this->set('titleForLayout', '参加者詳細');
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
		$this->set('titleForLayout', '参加者追加');
		if ($this->request->is('post')) {
			$this->EntryInfo->create();
			if ($this->EntryInfo->save($this->request->data)) {
				$this->Session->setFlash(__('登録しました'));
				$this->Session->write('event_info_id', $this->request->data['EntryInfo']['event_info_id']);
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
		$this->set('titleForLayout', '参加者編集');
		if (!$this->EntryInfo->exists($id)) {
			throw new NotFoundException(__('Invalid entry info'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->EntryInfo->save($this->request->data)) {
				$this->Session->write('event_info_id', $this->request->data['EntryInfo']['event_info_id']);
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
		$eventId = $this->Session->read('event_info_id');
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

		$this->set('titleForLayout', '参加者受付');
		
		$eventData = $this->EventInfo->find('first', array(
					'conditions' => array(
						'EventInfo.id' => $eventId)
					)
				);
		$this->set('eventTitle', $eventData['EventInfo']['title']);

		if ($this->request->is(array('post', 'put'))) {
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
						return;
					}

					$entryData['EntryInfo']['status_id'] = '1';

					if ($this->EntryInfo->save($entryData)) {
						$this->Session->setFlash(__($entryData['EntryInfo']['name'] . '様の受付をしました'));
						return $this->redirect(array('action' => 'updateByBarcode'));;
					} else {
						$this->Session->setFlash(__('更新に失敗しました'));
						return;
					}
					
				} else {
					$this->Session->setFlash(__('対象者は参加者一覧に存在しません'));
					return;
				}
			} else {
				$this->Session->setFlash(__('イベントを指定し、参加者一覧から入力してください'));
				return;
			}
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
		$this->set('titleForLayout', '参加者削除');
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

			$this->Session->setFlash(__('取り込み完了しました。'));
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

		// データ登録処理
		$this->EntryInfo->insertData($data);
	}

	public function createPDF() {
		
		// ==================================
		
		// $data = $this->EntryInfo->getList();

		$event_id = $this->Session->read('event_info_id');
		$entry_ids = $this->request->data['check'];
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
			array('conditions' => array('EntryInfo.event_info_id' => $event_id, 'EntryInfo.id' => $entry_ids))
			);

		if (count($entryInfo) == 0) {
			$this->Session->setFlash(__('参加者情報がありません'));
			return;
		}

		$eventData = $eventInfo[0]['EventInfo'];
		$eventTime = date('Y年n月j日  G時i分 ～ ', strtotime($eventData['event_date']));
		$eventTime = $eventTime . date('G時i分', strtotime($eventData['event_end_date']));
		$publishedTime = date('Y年n月j日', strtotime($eventData['published_date']));

		foreach ($entryInfo as $k => $v) {
			$userName = str_replace(' ', '', $v['EntryInfo']['name']);
			$userName = str_replace('　', '', $userName);
			$baseFileName = 'ENTRY_ID' . $v['EntryInfo']['id'] . '_' . trim($v['EntryInfo']['medical_instition']) . '_' . trim($userName) . '様.pdf';
			$fileName = mb_convert_encoding($baseFileName, 'sjis-win', 'UTF-8');
			$barcode_id = str_pad($v['EntryInfo']['id'], 12, 0, STR_PAD_LEFT);
			$barcode_file = 'BC_' . $barcode_id . 'png';
			// バーコード作成
			$this->__createBarcord($barcode_id, $barcode_file);
			
			$report = new Thinreports\Report(FILE_TEMPLATE . 'event_guid_ja.tlf');

			// イベント情報
			$page = $report->addPage();
			$page->item('published_date')->setValue($publishedTime);
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
		$image = $code->draw('000537', 'code128', 'png', false);
		// $this->set('test', base64_encode($image));
		imagepng($image, FILE_BARCORD . $fileName);

	}

	public function __setStatusBox($status) {
		$this->set('statuses', array('未入場', '受付済', '代理受付'));
		$this->set('status_selected', $status);
	}

	public function outputEntrylist() {

		$event_id = $this->Session->read('event_info_id');
		$entryInfo = $this->EntryInfo->find(
			'all',
			array('conditions' => array('EntryInfo.event_info_id' => $event_id))
			);
		if (count($entryInfo) == 0) {
			$this->Session->setFlash(__('参加者情報がありません'));
			return;
		}

		$book = new PHPExcel();

		$book->setActiveSheetIndex(0);
    	$sheet = $book->getActiveSheet();
    	$sheet->setTitle('参加者一覧');

    	$sheet->setCellValue('A1', '開催情報マスタNo');
		$sheet->setCellValue('B1', '状態');
		$sheet->setCellValue('C1', '開催日');
		$sheet->setCellValue('D1', '医療機関No.');
		$sheet->setCellValue('E1', '医療機関名');
		$sheet->setCellValue('F1', '参加者No.');
		$sheet->setCellValue('G1', '所属');
		$sheet->setCellValue('H1', '役職');
		$sheet->setCellValue('I1', '氏名');
		$sheet->setCellValue('J1', '電話番号1');
		$sheet->setCellValue('K1', '電話番号2');
		$sheet->setCellValue('L1', 'FAX');
		$sheet->setCellValue('M1', 'メールアドレス');
		$sheet->setCellValue('N1', '郵便番号');
		$sheet->setCellValue('O1', '住所');
		$sheet->setCellValue('P1', '備考');

		$status = array('未入場', '受付済', '代理受付');

    	$cnt_c = 2;
    	foreach($entryInfo as $k => $v ){
    		$read_date = date('Y-M-d', strtotime($v['EntryInfo']['event_date']));
			$display_date = PHPExcel_Shared_Date::PHPToExcel(new DateTime($read_date));
			$sheet->getStyle('C'.$cnt_c)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);

    		$sheet->setCellValue('A'.$cnt_c, $v['EntryInfo']['event_info_id']);
			$sheet->setCellValue('B'.$cnt_c, $status[intval($v['EntryInfo']['status_id'])]);
			$sheet->setCellValue('C'.$cnt_c, $display_date);
			$sheet->setCellValue('D'.$cnt_c, $v['EntryInfo']['medical_instition_no']);
			$sheet->setCellValue('E'.$cnt_c, $v['EntryInfo']['medical_instition']);
			$sheet->setCellValue('F'.$cnt_c, $v['EntryInfo']['participant_no']);
			$sheet->setCellValue('G'.$cnt_c, $v['EntryInfo']['department']);
			$sheet->setCellValue('H'.$cnt_c, $v['EntryInfo']['post']);
			$sheet->setCellValue('I'.$cnt_c, $v['EntryInfo']['name']);
			$sheet->setCellValue('J'.$cnt_c, $v['EntryInfo']['tel_no1']);
			$sheet->setCellValue('K'.$cnt_c, $v['EntryInfo']['tel_no2']);
			$sheet->setCellValue('L'.$cnt_c, $v['EntryInfo']['fax']);
			$sheet->setCellValue('M'.$cnt_c, $v['EntryInfo']['mail_address']);
			$sheet->setCellValue('N'.$cnt_c, $v['EntryInfo']['postal_code']);
			$sheet->setCellValue('O'.$cnt_c, $v['EntryInfo']['address']);
			$sheet->setCellValue('P'.$cnt_c, $v['EntryInfo']['remarks']);

			$cnt_c++;
		}



		$objWriter = new PHPExcel_Writer_Excel2007($book);
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		header("Content-Disposition: attachment;filename=entry_export.xlsx");
		header("Content-Transfer-Encoding: binary ");
		$objWriter->save('php://output');
	}
}
