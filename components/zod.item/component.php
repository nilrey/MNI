<?php
$showPost ;
global $DB;
global $USER;
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
	$table_name = 'mon_exp_final_report';
	$arTableFields =  $DB->getTableFields($table_name);
	if( $itemId > 0){
		$arFields['exp_id'] = $itemId;
		$arFields['final_report'] = intval($_POST['EXPEDITION']['final_report']);

		foreach ($USER->getGroups() AS $userGroup){
			if (!empty($userGroup) && $userGroup != 2){
				$arFields['group_id'] = $userGroup;
				deleteQuery("DELETE FROM {$table_name} WHERE exp_id={$arFields['exp_id']} AND group_id={$arFields['group_id']}", '', '' );
				constructQueryInsert(false, $table_name, $arFields, $arTableFields, $arError );
			}
		}

		if($arFields['final_report'] == 1){
			$query = "SELECT count(*) as counter FROM mon_exp_final_report t4 RIGHT JOIN
							(SELECT t1.exp_id, t2.* FROM
								(SELECT a1.mnitype, a1.exp_id FROM mon_exp_mnitype a1 WHERE a1.exp_id={$arFields['exp_id']} GROUP BY a1.mnitype)
								t1 LEFT JOIN mon_group_mnitype t2 ON t1.mnitype=t2.mnitype GROUP BY t2.group_id) t3 ON t4.exp_id=t3.exp_id AND t3.group_id=t4.group_id WHERE t4.final_report IS NULL OR  t4.final_report = 0";
			$arDebts = $DB->getSingleFieldArray($query);
			var_dump($arDebts[0]);
			if( !is_array($arDebts) || $arDebts[0] == 0 ){
				constructQueryUpdate(false, 'mon_expedition', array('status'=>30), array('status'), $arError, $itemId );
			}
		}else{
				constructQueryUpdate(false, 'mon_expedition', array('status'=>20), array('status'), $arError, $itemId );
		}

	}

	if(!$showPost){
		$redirect = "/zod/zod_exp_item.php?eid={$itemId}";
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

		$arResult['EQUIP'] = array();
		$query = "SELECT * FROM mon_exp_equip WHERE exp_id={$EXPEDITION_ID} ORDER BY block, id";
		$arResult['EQUIP'] = $DB->getRecordsAssoc($query);

		$arResult['RECLAIMS'] = array();
		$query = "SELECT * FROM mon_reclaim_files WHERE exp_id={$EXPEDITION_ID} ORDER BY create_date DESC, id DESC" ;
		$arResult['RECLAIMS'] = $DB->getRecordsAssoc($query);

		$arResult['STATUS'] = array(0=>'Заполняется', 10=>'Оформлен', 11=>'Возвращен на доработку', 12=>'Доработан', 20=>'Принят', 21=>'Прекращен', 22=>'Приостановлен', 30=>'Выполнен');

		$arResult['EXPEDITION']['final_report'] = array();
		$query = "SELECT final_report FROM mon_exp_final_report WHERE exp_id={$EXPEDITION_ID} AND group_id IN (".implode(', ', $USER->getGroups()).")";
		$arTmp = $DB->getSingleFieldArray($query);
		$arResult['EXPEDITION']['final_report'] = $arTmp[0];

//	}
}

$arResult['BASE_URL'] = $PAGE->getBasePageUrl().'?1=1'.(isset($EXPEDITION_ID) ? '&eid='.$EXPEDITION_ID : null);

if(!empty($_REQUEST['print'])){	$PAGE->IncludeModule('print', $arResult); }


?>