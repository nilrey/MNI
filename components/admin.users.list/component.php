<?php
accessAdminOnly();

global $DB;
if(!empty($_POST['deleteId']) ){
	$res = false;
	$deleteId = intval($_POST['deleteId']);
	// проверить права пользователя на экспедицию
	if($deleteId > 0){
		$query = "SELECT * FROM mon_users WHERE id={$deleteId} ";
		$arTmp = $DB->getRecord($query);
		if(count($arTmp) > 0){
			// удалить все записи из ВСЕХ связанных таблиц
			$query = "UPDATE mon_expedition SET active=0 WHERE id={$arTmp['id']}";
//			var_dump($query);
			$DB->setRecord($query);
		}
	}
	//var_dump($res);
}
$query = "SELECT * FROM mon_users";
$arResult['USERS'] = $DB->getRecordsAssoc($query);
?>