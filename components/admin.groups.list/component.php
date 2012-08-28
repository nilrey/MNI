<?php
accessAdminOnly();

global $DB;
if(!empty($_POST['deleteId']) ){
	$res = false;
	$deleteId = intval($_POST['deleteId']);
	// проверить права пользователя на экспедицию
	if($deleteId > 0){
		$query = "SELECT * FROM mon_groups WHERE id={$deleteId} ";
		$arTmp = $DB->getRecord($query);
	}
	//var_dump($res);
}
$query = "SELECT * FROM mon_groups";
$arResult['USERS'] = $DB->getRecordsAssoc($query);
?>