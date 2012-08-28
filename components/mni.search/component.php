<?php
global $DB;
$arResult['REFBOOK']['departments'] = getReferenceBook('departments');

if(!$USER->isAdmin()){
	$checkUser = "user_id={$USER->getUserId()} AND status > 0 AND";
}

if(!empty($_REQUEST['SEARCH'])){
	$arResult['SEARCH'] = $_REQUEST['SEARCH'];
	foreach ($arResult['SEARCH'] as $key=>$value){
		$arResult['QSTRING'] .= "&SEARCH[{$key}]={$value}";
	}
}


$query = "SELECT * FROM mon_expedition WHERE status =30 AND active=1";

// get statuses depend on user Role
$arResult['STATUS'] = array(0=>'Заполняется', 10=>'Оформлен', 11=>'Возвращен на доработку', 12=>'Доработан', 20=>'Принят', 21=>'Прекращен', 22=>'Приостановлен', 30=>'Выполнен');
$arResult['EXPEDITIONS'] = $DB->getRecordsAssoc($query);
?>