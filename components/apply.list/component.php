<?php
global $DB;
if(!empty($_POST['deleteId']) ){
	$res = false;
	$deleteId = intval($_POST['deleteId']);
	// проверить права пользователя на экспедицию
	if($deleteId > 0){
		$query = "SELECT * FROM mon_expedition WHERE user_id={$USER->getUserId()} AND id={$deleteId} ";
		$arTmp = $DB->getRecord($query);
		if(count($arTmp) > 0){
			// удалить все записи из ВСЕХ связанных таблиц
			$query = "DELETE FROM  mon_expedition WHERE id={$arTmp['id']}";
//			var_dump($query);
			$DB->setRecord($query);
			foreach (array("mon_exp_coords", "mon_exp_equip", "mon_exp_equip_dates", "mon_exp_tables_comment", "mon_exp_files", "mon_exp_final_report", "mon_exp_mnitype", "mon_exp_org", "mon_exp_pers", "mon_exp_ships", "mon_exp_ports", "mon_exp_tech", "mon_exp_transp", "mon_exp_transports") as $table) {
				$query = "DELETE FROM  {$table} WHERE exp_id={$arTmp['id']}";
				$DB->setRecord($query);
			}
		}
	}
	//var_dump($res);
}

if(!$USER->isAdmin()){
	$checkUser = "user_id={$USER->getUserId()} AND";
}

//var_dump(($arParams["STATUS"]) );
if(!empty($arParams["STATUS"])){
	$checkStatus = " status IN (".implode(", ", $arParams["STATUS"]).") AND ";
}
//var_dump($_SESSION);
//------------------------------------------------ SORTING -------------------------------------------------------------
$ORDERBY_TYPE = $arParams['ORDERBY'];
$dir = ' ASC ';
$sort = ' ORDER BY date_start DESC';
$arSort = array("FIELD" => '', "DIR"=>'');
if(!isset($_SESSION[$ORDERBY_TYPE]['ORDERBY'])) $_SESSION[$ORDERBY_TYPE]['ORDERBY'] = array('year' => date('Y')+1 , 'status' => -1, 'dir'=>'desc', 'fld' => 'date_start');
if(empty($_REQUEST['ORDERBY'])) $_REQUEST['ORDERBY'] = array();
$arSort = array_merge($_SESSION[$ORDERBY_TYPE]['ORDERBY'], $_REQUEST['ORDERBY']);

if( intval($arSort['year']) > 1990){
		$date_from  = $arSort['year'].'-01-01';
		$date_to =  (intval($arSort['year'])+1).'-01-01';
		$selectByYear = " date_start >= '{$date_from}' AND date_start <= '{$date_to}' AND ";
}else {
	$selectByYear = "";
}
if( is_numeric($arSort['status']) && intval($arSort['status']) > -1){
		$selectByYear = " status = '{$arSort['status']}' AND ";
}else {
	$selectByYear = "";
}

$arSort['dir'] !== "asc" ? $arSort['dir'] = 'desc' : null ;
switch ($arSort['fld']){
	case 'date_start':
		$sort = " ORDER BY date_start {$arSort['dir']}";
		break;
	case 'date_end':
		$sort = " ORDER BY date_end {$arSort['dir']}";
		break;
	case 'mni_name':
		$sort = " ORDER BY mni_name {$arSort['dir']}";
		break;
}

$arResult['ORDERBY'] = $arSort;
$_SESSION[$ORDERBY_TYPE]['ORDERBY'] = $arResult['ORDERBY'];
//------------------------------------------------ \ SORTING -------------------------------------------------------------

$query = "SELECT * FROM mon_expedition WHERE {$checkUser} {$checkStatus} {$selectByYear} active=1 {$sort}";
//var_dump($query);

// get statuses depend on user Role
$arResult['STATUS'] = array(0=>'Заполняется', 10=>'Оформлен', 11=>'Возвращен на доработку', 12=>'Доработан', 13=>'Отменен', 20=>'Принят', 21=>'Прекращен', 22=>'Приостановлен', 30=>'Выполнен');
$arResult['EXPEDITIONS'] = $DB->getRecordsAssoc($query);

$arResult['YEARS'] = array();
if(count($arResult['EXPEDITIONS']) > 0){
	$query = "SELECT MAX(date_start) as maxdate, MIN(date_start) as mindate FROM mon_expedition WHERE {$checkUser} {$checkStatus} active=1";
//var_dump($query);
	$arResult['YEARS'] = $DB->getRecord($query);
}
$arResult['BASE_URL'] = $PAGE->getBasePageUrl().'?1=1';


?>