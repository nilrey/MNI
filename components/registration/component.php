<?php
global $DB;
//include($_SERVER['DOCUMENT_ROOT'].'/mail.php');

$arResult['VARIABLES'] = array();
$arResult['REFBOOK'] = array();

$arResult['REFBOOK']['countries'] = getReferenceBook('countries');
$arResult['REFBOOK']['departments'] = getReferenceBook('departments');
$arResult['REFBOOK']['mnitype'] = getReferenceBook('mnitype');
$arResult['REFBOOK']['mnisort'] = getReferenceBook('mnisort');
foreach ($arResult['REFBOOK']['mnisort'] as $arValue) {
	$arResult['REFBOOK']['mnisort_ord'][$arValue['mnitype']][] = $arValue;
}
$arResult['REFBOOK']['mniunit'] = getReferenceBook('mniunit');
$arResult['REGISTRATION_RESULT'] = false;

//var_dump($_REQUEST['REGFORM']);
if (!empty($_REQUEST['saveReg'])){
	$arResult['VARIABLES']['orgNameFull'] = htmlspecialchars($_REQUEST['REGFORM']['orgNameFull']);
	$arResult['VARIABLES']['orgNameShort'] = htmlspecialchars($_REQUEST['REGFORM']['orgNameShort']);
	$arResult['VARIABLES']['orgDepartment'] = htmlspecialchars($_REQUEST['REGFORM']['department']);
	$arResult['VARIABLES']['country'] = htmlspecialchars($_REQUEST['REGFORM']['country']);
	$arResult['VARIABLES']['city'] = htmlspecialchars($_REQUEST['REGFORM']['adrCity']);
	$arResult['VARIABLES']['legalAddress'] = htmlspecialchars($_REQUEST['REGFORM']['legalAddress']);
	$arResult['VARIABLES']['postAddress'] = htmlspecialchars($_REQUEST['REGFORM']['postAddress']);
	$arResult['VARIABLES']['phone'] = htmlspecialchars($_REQUEST['REGFORM']['phone']);
	$arResult['VARIABLES']['fax'] = htmlspecialchars($_REQUEST['REGFORM']['fax']);
	$arResult['VARIABLES']['name'] = htmlspecialchars($_REQUEST['REGFORM']['contactName']);
	$arResult['VARIABLES']['contactPhone'] = htmlspecialchars($_REQUEST['REGFORM']['contactPhone']);
	$arResult['VARIABLES']['contactEmail'] = trim($_REQUEST['REGFORM']['contactEmail']);
	$arResult['VARIABLES']['login'] = htmlspecialchars($_REQUEST['REGFORM']['login']);
	$arResult['VARIABLES']['pass'] = htmlspecialchars($_REQUEST['REGFORM']['password']);
	$arResult['VARIABLES']['confirmPassword'] = htmlspecialchars($_REQUEST['REGFORM']['confirmPassword']);

	if (empty($arResult['VARIABLES']['pass'])){
			$arResult['ERRORS'] = 'Пустой пароль недопустим!';
	}else if ($arResult['VARIABLES']['pass'] !== $arResult['VARIABLES']['confirmPassword']){
			$arResult['ERRORS'] = 'Пароль и подтверждение не совпадают';
	}else{

		$query = sprintf("SELECT COUNT(*) as users FROM mon_users WHERE login='%s' ",
	          $DB->real_escape_string($arResult['VARIABLES']['login']));
		$res = $DB->getRecord($query);

		if( empty($res['users']) ){

		$query = "SELECT id FROM mon_groups WHERE name='registred' ";
		$res = $DB->getRecord($query);
		$registredGroupId = $res['id'];

		$table_name = 'mon_users';
		$arTableFields =  $DB->getTableFields($table_name);
		$arResult['VARIABLES']['pass'] = md5($arResult['VARIABLES']['pass']);
		$userID = constructQueryInsert(false, $table_name, $arResult['VARIABLES'], $arTableFields, $arError  );

//		$query = sprintf("INSERT INTO mon_users ( name, login, pass, active) VALUES ( '%s', '%s', '%s', %d) ",
//			$DB->real_escape_string($arResult['VARIABLES']['contactName']),
//			$DB->real_escape_string($arResult['VARIABLES']['login']),
//			md5($_REQUEST['password']),
//			'0'
//		);
//		$DB->query($query);

		if($userID > 0){
			$applicantGroupId = 3;
			$query = sprintf("INSERT INTO mon_usergroups (group_id, user_id) VALUES (%d,  %d) ",
				$applicantGroupId,
				$userID);
				$DB->query($query);
				if($DB->insert_id > 0){
					// success registration
					$arResult['REGISTRATION_RESULT'] = true;


//var_dump(sendMailNew());
					//Замените настройки на нужные.
					$mail_to = $arResult['VARIABLES']['contactEmail'];//'nilrey@inevm.ru'; //вам потребуется указать здесь Ваш настоящий почтовый ящик, куда должно будет прийти письмо.
					$type = 'plain'; // html \ plain
					$charset = 'UTF-8';
					$message = "успешная регистрация";
					$subject = "Регистрация на сайте www.mni.citis.ru";
					$subject = "Сообщение с сайта cntis.ru";
					$message = "
Уважаемый, {$arResult['VARIABLES']['name']}\n
Ваша регистрация прошла успешно.\n
В течении ближайшего времени Ваши данные будут проверены, и аккаунт будет активирован.\n
Если по каким-либо причинам Вам не пришло письмо с подтверждением по истечении 2х дней, просьба обратиться по тел. 8 (499) 702 8205 (г. Москва).\n
-----------------------------------------------------------------------
\nУважаемые пользователи,\nданное письмо является подтверждением и  сгенерировано автоматически. Отвечать на него не нужно.\n\nСпасибо за внимание к нашему проекту.";
					$mail_from = "info@mni.esimo.ru";
					$replyto = "Administrator";
					$headers = "To: \"Administrator\" <$mail_to>\r\n".
	          "From: \"$replyto\" <$mail_from>\r\n".
	          "Reply-To: $mail_from\r\n".
	          "Content-Type: text/$type; charset=\"$charset\"\r\n";
					$sended = smtpmail($mail_to, $subject, $message, $headers);

			   if (!$sended) {
				   	$arResult['ERRORS'] = "Сообщение не удалось отправить. Пожалуйста свяжитесь с администратором сайта по тел. 8 (499) 702 8205 (г. Москва)</p>";
			   }else{

						$mail_to = 'nilrey@inevm.ru';
						$subject = "Новый пользователь зарегистрировался на сайте www.mni.citis.ru";
						$message = "
Пользователь {$arResult['VARIABLES']['name']} зарегистрировался на сайте www.mni.citis.ru\n\n
Регистрационные данные: \n
Контактное лицо: {$arResult['VARIABLES']['name']}\n
Телефон: {$arResult['VARIABLES']['contactPhone']}\n
E-mail: {$arResult['VARIABLES']['contactEmail']}\n
Организация: {$arResult['VARIABLES']['orgNameFull']}\n
Почтовый адрес: {$arResult['VARIABLES']['postAddress']}\n
Телефон:  {$arResult['VARIABLES']['phone']}\n
Факс:  {$arResult['VARIABLES']['fax']}\n

-----------------------------------------------------------------------\n
http://www.mni.citis.ru\n

Конец сообщения.
					";

					$mail_from = "info@mni.esimo.ru";
					$replyto = "Administrator";
					$headers = "To: \"Administrator\" <$mail_to>\r\n".
	          "From: \"$replyto\" <$mail_from>\r\n".
	          "Reply-To: $mail_from\r\n".
	          "Content-Type: text/$type; charset=\"$charset\"\r\n";
					$sended = smtpmail($mail_to, $subject, $message, $headers);

					}


			}else{
				$arResult['ERRORS'] = 'Ошибка регистрации аккаунта. Неопределена группа.';
			}
		}else{
			$arResult['ERRORS'] = 'Ошибка регистрации аккаунта. Данные не сохранены.';
		}

		}else{
			// Message This account already exists
			$arResult['ERRORS'] = 'Извините, данный логин занят.';
		}
	}
}
?>