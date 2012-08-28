<?php
accessAdminOnly();

global $DB;

$showPost;
//var_dump($_POST);
$arError = array();
$arResult['EDIT_GROUP'] = array();
if(!empty($_POST["name"]) ){
	$table_name = 'mon_groups';
	$arTableFields =  $DB->getTableFields($table_name);
	
	if(!empty($_POST["active"])) $arFields['active'] = 1; else $arFields['active'] = 0;
	$arFields['name'] = prepareValue($_POST["name"]);
	$userId = intval($_POST['eid']);
	if (!empty($userId) ) {
		// update
		constructQueryUpdate(false, $table_name, $arFields, $arTableFields, $arError , $userId );
		if($userId > 0 && is_array($_POST["mnitype"]) && count($_POST["mnitype"]) > 0){
			$table_name = 'mon_group_mnitype';
			deleteQuery("DELETE FROM {$table_name} WHERE group_id={$userId}", '', '' );
			foreach ($_POST["mnitype"] as $group) {
				$group = htmlspecialchars($group);
				$table_name = 'mon_group_mnitype';
				$arTableFields =  $DB->getTableFields($table_name);
				$arFields['mnitype'] = $group;
				$arFields['group_id'] = $userId;
				constructQueryInsert(false, $table_name, $arFields, $arTableFields, $arError  );
			}
		}
	}else{
		// insert
		$arFields['login'] = prepareValue($_POST["login"]);
		
		$query = "SELECT count(*) as counter FROM mon_groups WHERE name='{$arFields['login']}' ";
		$checkLogin = $DB->getSingleFieldArray($query);
		if( intval($checkLogin[0]) === 0){
			
			$table_name = 'mon_groups';
			$arTableFields =  $DB->getTableFields($table_name);
			$userId = constructQueryInsert(false, $table_name, $arFields, $arTableFields, $arError  );
			if($userId > 0 && is_array($_POST["groups"]) && count($_POST["groups"]) > 0){
				$table_name = 'mon_group_mnitype';
				$arTableFields =  $DB->getTableFields($table_name);
				$arFields['group_id'] = $userId;
				foreach ($_POST["mnitype"] as $group) {
					$arFields['mnitype'] = intval($group);
					constructQueryInsert(false, $table_name, $arFields, $arTableFields, $arError  );
				}
			}
			if(!$showPost){
				$redirect = "/settings/groups/editgroup.php?eid={$userId}";
				header("location: {$redirect}");
			}			
		}else{
			$arResult['EDIT_GROUP'] = $arFields;
			$arResult['ERROR'] = 'Login already exists';
		}
	}
}



if(!empty($_REQUEST['eid']) ){
	$res = false;
	$itemId = intval($_REQUEST['eid']);
	// проверить права пользователя на экспедицию
	if($itemId > 0){
		$query = "SELECT * FROM mon_groups WHERE id={$itemId} ";
		$arResult['EDIT_GROUP'] = $DB->getRecord($query);
		$query = "SELECT * FROM mon_group_mnitype WHERE group_id={$itemId} ";
		$arResult['EDIT_GROUP']['mnitype'] = $DB->getRecordsAssoc($query);
	}
}
$query = "SELECT * FROM mon_rb_mnitype WHERE active=1 ORDER BY name";
$arResult['GROUPS'] = $DB->getRecordsAssoc($query);

?>