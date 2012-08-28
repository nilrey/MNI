<?php
$showPost;
global $DB;
$arResult['REFBOOK']['countries'] = getReferenceBook('countries');
$arResult['REFBOOK']['departments'] = getReferenceBook('departments');
$arResult['REFBOOK']['mnitype'] = getReferenceBook('mnitype');
$arResult['REFBOOK']['mnisort'] = getReferenceBook('mnisort');
foreach ($arResult['REFBOOK']['mnisort'] as $arValue) {
	$arResult['REFBOOK']['mnisort_ord'][$arValue['mnitype']][] = $arValue;
}
$arResult['REFBOOK']['mniunit'] = getReferenceBook('mniunit');

if(!empty($_POST) ){
	$itemId = intval($_POST['eid']);
	$table_name = 'mon_expedition';
	$arTableFields =  $DB->getTableFields($table_name);
	if( $itemId > 0){
		$arFields['status'] = intval($_POST['EXPEDITION']['statusExpedition']);
		constructQueryUpdate(false, $table_name, $arFields, $arTableFields, $arError , $itemId );
	}
	if(!empty($_FILES["reclaimFile"]) && $_FILES["reclaimFile"]["size"] > 0){
		$newFileName = date(U).substr($_FILES['reclaimFile']['name'], strrpos($_FILES['reclaimFile']['name'], chr(46)));
		$newFilePath = $_SERVER['DOCUMENT_ROOT'].'/files/reclaim/'.$newFileName;
		if(copy($_FILES['reclaimFile']['tmp_name'], $newFilePath ) ){
			$table_name = 'mon_reclaim_files';
			$arTableFields =  $DB->getTableFields($table_name);
			$arFields = array();
			$arFields['exp_id'] = $itemId;
			$arFields['name'] = $newFileName;
			$arFields['create_date'] = date('Y-m-d');
			$arFields['orig_name'] = $_FILES['reclaimFile']['name'];
			$arFields['comments'] = htmlspecialchars($_POST['reclaimComments']);
			constructQueryInsert(false, $table_name, $arFields, $arTableFields, $arError );
		}
	}

	if(!$showPost){
		$redirect = "/mon/mon_exp_item.php?eid={$itemId}";
		$redirect.='&act=save';
		header("location: {$redirect}");
	}

	if($showPost){	var_dump($_POST);	}

}

if(!empty($_REQUEST['eid']) && intval($_REQUEST['eid']) > 0 ){
	$EXPEDITION_ID = intval($_REQUEST['eid']);
	$query = "SELECT * FROM mon_expedition WHERE id={$EXPEDITION_ID} ORDER BY date_start DESC , mni_name";
	$arResult['EXPEDITION'] = $DB->getRecord($query);
//	if($USER->getUserId() == $arResult['EXPEDITION']['user_id']){

		$arResult['APPLICANT'] = array();
		$arResult['EXECUTOR'] = array();
		$arResult['PARTICIPANT'] = array();
		$query = "SELECT * FROM mon_exp_org WHERE exp_id={$EXPEDITION_ID}";
		$arTmp = $DB->getRecordsAssoc($query);
		foreach ($arTmp as $arItem) {
			$arItem['type'] = 1;
			switch (strtoupper($arItem['record_type']) ){
				case 'APP':
					$arResult['APPLICANT'] = $arItem;
					break;
				case 'EXC':
					$arResult['EXECUTOR'] = $arItem;
					break;
				case 'PTC':
					$arResult['PARTICIPANT'][] = $arItem;
					break;
			}
		}

		$query = "SELECT * FROM mon_exp_pers WHERE exp_id={$EXPEDITION_ID}";
		$arTmp = $DB->getRecordsAssoc($query);
		foreach ($arTmp as $arItem) {
			$arItem['type'] = 2;
			switch (strtoupper($arItem['record_type']) ){
				case 'APP':
					$arResult['APPLICANT'] = $arItem;
					break;
				case 'EXC':
					$arResult['EXECUTOR'] = $arItem;
					break;
				case 'PTC':
					$arResult['PARTICIPANT'][] = $arItem;
					break;
			}
		}

		$arResult['TRANSPORT'] = array();
		$query = "SELECT * FROM mon_exp_transp WHERE exp_id={$EXPEDITION_ID} ORDER BY main_trs DESC, num, id";
		$arTmp = $DB->getRecordsAssoc($query);
		foreach ($arTmp as $arItem){
			switch ($arItem['type']){
				case 'ship':
					$query = "SELECT * FROM mon_exp_ships WHERE id={$arItem['trs_id']} ";
					$arShip = $DB->getRecord($query);
					$arShip['main_trs'] = $arItem['main_trs'];
					$arShip['num'] = $arItem['num'];
					$arShip['type'] = $arItem['type'];
					$arResult['TRANSPORT'][] = $arShip;
					break;
				case 'other':
					$query = "SELECT * FROM mon_exp_transports WHERE id={$arItem['trs_id']} ";
					$arShip = $DB->getRecord($query);
					$arShip['main_trs'] = $arItem['main_trs'];
					$arShip['num'] = $arItem['num'];
					$arShip['type'] = $arItem['type'];
					$arResult['TRANSPORT'][] = $arShip;
					break;
			}
		}

		$arResult['MAINTRANSPORT'] = array();
		if ($arResult['TRANSPORT'][0]['main_trs'] == 1){
			$arResult['MAINTRANSPORT'] = array_shift($arResult['TRANSPORT']);
		}

		$arResult['COORDS'] = array();
		$query = "SELECT * FROM mon_exp_coords WHERE exp_id={$EXPEDITION_ID} ORDER BY num, id";
		$arTmp = $DB->getRecordsAssoc($query);
		foreach ($arTmp as $arItem) {
			switch (strtolower($arItem['record_type']) ){
				case 'shiproot':
					$arResult['COORDS']['shiproot'][] = $arItem;
					break;
				case 'mniregion':
					$arResult['COORDS']['mniregion'][] = $arItem;
					break;
				case 'mniroot':
					$arResult['COORDS']['mniroot'][] = $arItem;
					break;
				case 'mnishore':
					$arResult['COORDS']['mnishore'][] = $arItem;
					break;
				case 'mniice':
					$arResult['COORDS']['mniice'][] = $arItem;
					break;
			}
		}

		$arResult['PORTS'] = array();
		$query = "SELECT * FROM mon_exp_ports WHERE exp_id={$EXPEDITION_ID} ORDER BY num, id";
		$arTmp = $DB->getRecordsAssoc($query);
		foreach ($arTmp as $arItem) {
			switch (strtolower($arItem['record_type']) ){
				case 'ports':
					$arResult['PORTS']['ports'][] = $arItem;
					break;
			}
		}

		$arResult['MNITYPE'] = array();
		$query = "SELECT * FROM mon_exp_mnitype WHERE exp_id={$EXPEDITION_ID} ORDER BY num, id";
		$arTmp = $DB->getRecordsAssoc($query);
		foreach ($arTmp as $arItem) {
				$arResult['MNITYPE']['meteo'][] = $arItem;
		}

		$arResult['TECH'] = array();
		$query = "SELECT * FROM mon_exp_tech WHERE exp_id={$EXPEDITION_ID}";
		$arResult['TECH'] = $DB->getRecord($query);
		foreach ($arResult['TECH'] as &$arValue) {
			$arValue = str_replace('\\', '', $arValue);
		}

		$arResult['EQUIP'] = array();
		$query = "SELECT * FROM mon_exp_equip WHERE exp_id={$EXPEDITION_ID} ORDER BY block, id";
		$arResult['EQUIP'] = $DB->getRecordsAssoc($query);

		$arResult['PREREPORT'] = array();
		$query = "SELECT * FROM mon_exp_files WHERE exp_id={$EXPEDITION_ID} ORDER BY create_date DESC, id DESC" ;
		$arResult['PREREPORT'] = $DB->getRecordsAssoc($query);

		$arResult['RECLAIMS'] = array();
		$query = "SELECT * FROM mon_reclaim_files WHERE exp_id={$EXPEDITION_ID} ORDER BY create_date DESC, id DESC" ;
		$arResult['RECLAIMS'] = $DB->getRecordsAssoc($query);

		$arResult["STATUS"] = array();
		switch ($arResult["EXPEDITION"]["status"]){
			case 10:
				$arResult["STATUS"] = array(10=>'оформлен',20=>'принять',11=>'вернуть на доработку');
				break;
			case 11:
				$arResult["STATUS"] = array(11=>'вернуть на доработку');
				break;
			case 12:
				$arResult["STATUS"] = array(12=>'доработан',20=>'принять',11=>'вернуть на доработку');
				break;
			case 20:
//				var_dump(date('Y-m-d'));
//				var_dump( $arResult["EXPEDITION"]["date_start"]);
				if(date('Y-m-d') > $arResult["EXPEDITION"]["date_start"]){
					$arResult["STATUS"] = array(21=>'прекратить',22=>'приостановить',20=>'принят',30=>'выполнен');
				}
				break;
			case 30:
				$arResult["STATUS"] = array(30=>'выполнен');
				break;

		}

//	}
}

$arResult['BASE_URL'] = $PAGE->getBasePageUrl().'?1=1'.(isset($EXPEDITION_ID) ? '&eid='.$EXPEDITION_ID : null);

if(!empty($_REQUEST['print'])){	$PAGE->IncludeModule('print', $arResult); }

?>