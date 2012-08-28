<?php
accessAdminOnly();

global $DB;
$arResult['REFBOOK']['countries'] = getReferenceBook('countries');
$arResult['REFBOOK']['departments'] = getReferenceBook('departments');

//var_dump($_POST);
$arError = array();
$arResult['EDIT_USER'] = array();
if(!empty($_POST["EDIT_USER"]["name"]) ){
	$table_name = 'mon_users';
	$arTableFields =  $DB->getTableFields($table_name);

	if(!empty($_POST["EDIT_USER"]["active"])) $arFields['active'] = 1; else $arFields['active'] = 0;


	$arFields['name'] = prepareValue($_POST["EDIT_USER"]["name"]);
	$arFields['contactEmail'] = prepareValue($_POST["EDIT_USER"]["contactEmail"]);
	$arFields['orgNameFull'] = prepareValue($_POST["EDIT_USER"]["orgNameFull"]);
	$arFields['orgNameShort'] = prepareValue($_POST["EDIT_USER"]["orgNameShort"]);
	$arFields['orgDepartment'] = prepareValue($_POST["EDIT_USER"]["department"]);
	$arFields['country'] = prepareValue($_POST["EDIT_USER"]["country"]);
	$arFields['city'] = prepareValue($_POST["EDIT_USER"]["adrCity"]);
	$arFields['legalAddress'] = prepareValue($_POST["EDIT_USER"]["legalAddress"]);
	$arFields['phone'] = prepareValue($_POST["EDIT_USER"]["phone"]);
	$arFields['fax'] = prepareValue($_POST["EDIT_USER"]["fax"]);
	if(!empty($_POST["EDIT_USER"]["pass"])) $arFields['pass'] = md5($_POST["EDIT_USER"]["pass"]);

	$userId = intval($_POST['eid']);
	if (!empty($userId) ) {
		// update
		if($arFields["active"] != $_POST["EDIT_USER"]["active_orig"]){
			$sended = sendActivationMessage($arFields, $arFields["active"]);
			$arResult['MESSAGE'] = "Сообщение об активации отправлено.";
			if (!$sended) {
			 	$arResult['MESSAGE'] = "Сообщение об активации не удалось отправить.";
			}
		}


		constructQueryUpdate(false, $table_name, $arFields, $arTableFields, $arError , $userId );
		if($userId > 0 && is_array($_POST["groups"]) && count($_POST["groups"]) > 0){
			$table_name = 'mon_usergroups';
			deleteQuery("DELETE FROM {$table_name} WHERE user_id={$userId}", '', '' );
			foreach ($_POST["groups"] as $group) {
				$group = intval($group);
				$table_name = 'mon_usergroups';
				$arTableFields =  $DB->getTableFields($table_name);
				$arFields['group_id'] = $group;
				$arFields['user_id'] = $userId;
				constructQueryInsert(false, $table_name, $arFields, $arTableFields, $arError  );
				$arResult['MESSAGE'] = 'Запись успешно обновлена';
			}
		}
	}else{
		// insert
		$arFields['login'] = prepareValue($_POST["EDIT_USER"]["login"]);

		$query = "SELECT count(*) as counter FROM mon_users WHERE login='{$arFields['login']}' ";
		$checkLogin = $DB->getSingleFieldArray($query);
		if( intval($checkLogin[0]) === 0){

			$userId = constructQueryInsert(false, $table_name, $arFields, $arTableFields, $arError  );
			if($userId > 0 && is_array($_POST["groups"]) && count($_POST["groups"]) > 0){
				$table_name = 'mon_usergroups';
				$arTableFields =  $DB->getTableFields($table_name);
				$arFields['user_id'] = $userId;
				foreach ($_POST["groups"] as $group) {
					$arFields['group_id'] = intval($group);
					constructQueryInsert(false, $table_name, $arFields, $arTableFields, $arError  );
				}
			}
			if(!$showPost){
//				$redirect = "/settings/users/list.php?eid={$userId}";
//				header("location: {$redirect}");
			}
			if(empty($arResult['MESSAGE'])) $arResult['MESSAGE'] = 'Запись успешно обновлена';
		}else{
			$arResult['EDIT_USER'] = $arFields;
			$arResult['MESSAGE'] = 'Login already exists';
		}
	}
}


if(!empty($_REQUEST['eid']) ){
	$res = false;
	$itemId = intval($_REQUEST['eid']);
	if($itemId > 0){
		$query = "SELECT * FROM mon_users WHERE id={$itemId} ";
		$arResult['EDIT_USER'] = $DB->getRecord($query);
		$query = "SELECT * FROM mon_usergroups WHERE user_id={$itemId} ";
		$arResult['EDIT_USER']['groups'] = $DB->getRecordsAssoc($query);
	}
}
$query = "SELECT * FROM mon_groups WHERE active=1 ORDER BY name";
$arResult['GROUPS'] = $DB->getRecordsAssoc($query);

function sendActivationMessage($arFields, $activation = 1){
	if($activation){
		$info = "Ваш аккаунт успешно активирован.\n
Вы можете воспользоваться входом в личный кабинет: http://www.mni.citis.ru/personal/login.php";
	}else{
		$info = "Ваш аккаунт деактивирован.\n
Вы можете связаться с администратором через e-mail: nilrey@inevm.ru или по тел. 8 (499) 702 8205 (г. Москва)";
	}
	$mail_to = $arFields['contactEmail'];
	$mail_from = "info@mni.esimo.ru";
	$type = 'plain'; // html \ plain
	$charset = 'UTF-8';
	$replyto = "Administrator";
	$subject = "Сообщение с сайта www.mni.cntis.ru";
	$message = "
Уважаемый, {$arFields['name']}\n
{$info}

-----------------------------------------------------------------------
\nУважаемый пользователь,\nданное письмо является подтверждением и  сгенерировано автоматически. Отвечать на него не нужно.\n\nСпасибо за внимание к нашему проекту.";
	$headers = "To: \"Administrator\" <$mail_to>\r\n".
	  "From: \"$replyto\" <$mail_from>\r\n".
	  "Reply-To: $mail_from\r\n".
	  "Content-Type: text/$type; charset=\"$charset\"\r\n";
	$sended = smtpmail($mail_to, $subject, $message, $headers);

	return $sended;

}

?>