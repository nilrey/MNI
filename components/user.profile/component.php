<?php
global  $DB;

if(isset($_REQUEST['EDIT_USER'])){
	$itemId = $USER->getUserId();
	if($itemId > 0){
		$arFields['orgNameFull'] = htmlspecialchars($_REQUEST['EDIT_USER']['orgNameFull']);
		$arFields['orgNameShort'] = htmlspecialchars($_REQUEST['EDIT_USER']['orgNameShort']);
		$arFields['orgDepartment'] = htmlspecialchars($_REQUEST['EDIT_USER']['orgDepartment']);
		$arFields['country'] = htmlspecialchars($_REQUEST['EDIT_USER']['country']);
		$arFields['city'] = htmlspecialchars($_REQUEST['EDIT_USER']['city']);
		$arFields['legalAddress'] = htmlspecialchars($_REQUEST['EDIT_USER']['legalAddress']);
		$arFields['postAddress'] = htmlspecialchars($_REQUEST['EDIT_USER']['postAddress']);
		$arFields['phone'] = htmlspecialchars($_REQUEST['EDIT_USER']['phone']);
		$arFields['fax'] = htmlspecialchars($_REQUEST['EDIT_USER']['fax']);
		$arFields['telex'] = htmlspecialchars($_REQUEST['EDIT_USER']['telex']);
		$arFields['name'] = htmlspecialchars($_REQUEST['EDIT_USER']['contactName']);
		$arFields['contactPhone'] = htmlspecialchars($_REQUEST['EDIT_USER']['contactPhone']);
		$arFields['contactEmail'] = trim($_REQUEST['EDIT_USER']['contactEmail']);
		$arFields['pass'] = $_REQUEST['EDIT_USER']['password'];
		$arFields['confirmPassword'] = $_REQUEST['EDIT_USER']['confirmPassword'];
		if ( ( !empty($arFields['pass']) || !empty($arFields['confirmPassword']) ) && ($arFields['pass'] !== $arFields['confirmPassword'])){
				$arResult['MESSAGE'] = 'Пароль и подтверждение не совпадают';
		}else{

			$table_name = 'mon_users';
			$arTableFields =  $DB->getTableFields($table_name);
			if( empty($arFields['pass']) ) unset( $arFields['pass'] );
			else $arFields['pass'] = md5($arFields['pass']);

			if( constructQueryUpdate(false, $table_name, $arFields, $arTableFields, $arError , $itemId ) ){
				$arFields['id'] = $itemId;
				$USER->refreshUserParamsSession($arFields);

				header("location: ".$PAGE->getBasePageUrl()."?save=1");
			}else{
				$arResult['MESSAGE'] = "Изменения не удалось сохранить.";
			}

		}

	}
}elseif (isset($_REQUEST['save'])){
	$arResult['MESSAGE'] = "Изменения не удалось сохранить.";
	if(intval($_REQUEST['save']) > 0){
		$arResult['MESSAGE'] = "Изменения успешно сохранены.";
	}
}

$arResult['REFBOOK']['countries'] = getReferenceBook('countries');
$arResult['REFBOOK']['departments'] = getReferenceBook('departments');

$query = "SELECT * FROM mon_users WHERE id=".$USER->getUserId();

$arResult['EDIT_USER'] = $DB->getRecord($query);
?>