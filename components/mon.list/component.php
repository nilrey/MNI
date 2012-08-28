<?php
global $DB;

if(!$USER->isAdmin()){
	$checkUser = "user_id={$USER->getUserId()} AND status > 0 AND";
}

//$query = "SELECT * FROM mon_expedition WHERE status IN (10, 12, 20, 21, 22, 30) AND active=1";
if(!empty($arParams["STATUS"])){
	$checkStatus = " status IN (".implode(", ", $arParams["STATUS"]).") AND ";
}

$query = "SELECT * FROM mon_expedition WHERE {$checkStatus} active=1";

// get statuses depend on user Role
$arResult['STATUS'] = array(0=>'Заполняется', 10=>'Оформлен', 11=>'Возвращен на доработку', 12=>'Доработан', 20=>'Принят', 21=>'Прекращен', 22=>'Приостановлен', 30=>'Выполнен');
$arResult['EXPEDITIONS'] = $DB->getRecordsAssoc($query);
?>