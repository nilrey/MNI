<?require($_SERVER["DOCUMENT_ROOT"]."/header.php");?>
<? $PAGE->IncludeComponent('mail');?>
<?php
//function sendMailNew(){
//$resultInfo = array();
//$resultInfo["MESSAGE_REGISTR"]["result"] = true;
//$resultInfo["MESSAGE_REGISTR"]["message"] = "<p>Сообщение успешно зарегистрировано в системе</p>";
//if(1 == 1):
//
////Замените настройки на нужные.
//		$mail_to = 'nilrey@inevm.ru';//'cncepla5@inevm.ru' ; //'mgcntis@cntis.ru'; //вам потребуется указать здесь Ваш настоящий почтовый ящик, куда должно будет прийти письмо.
//		$type = 'plain'; // html \ plain
//		$charset = 'UTF-8';
//		$message = "успешная регистрация";
//		$subject = "Регистрация на сайте www.mni.citis.ru";
//		$mail_from = "info@mni.esimo.ru";
//		$replyto = "Administrator NC CEPLA";
//		$headers = "To: \"Administrator NC CEPLA\" <$mail_to>\r\n".
//		          "From: \"$replyto\" <$mail_from>\r\n".
//		          "Reply-To: $mail_from\r\n".
//		          "Content-Type: text/$type; charset=\"$charset\"\r\n";
//		$sended = smtpmail($mail_to, $subject, $message, $headers);
//	   if (!$sended) {
////	   	$resultInfo["MESSAGE_TO_USER"]["result"] = false;
//	   	echo  "<p >Сообщение не удалось отправить. Пожалуйста свяжитесь с администратором сайта по адресу: {$mail_to}</p>";
//	   }else{
//	   	/*
//		   	$resultInfo["MESSAGE_TO_USER"]["result"] = true;
//		   	$resultInfo["MESSAGE_TO_USER"]["message"] = "<p>Сообщение было успешно отправлено менеджеру</p>";
//
//		   	$mail_to = $MAIL["MAIL_TO"];
//				$subject = "Сообщение с сайта cntis.ru";
//				$message = "
//Ваше сообщение успешно получено.\n
//Контрольные данные: \n\n{$MAIL["MESSAGE"]}
//-----------------------------------------------------------------------
//\nУважаемые пользователи,\nданное письмо является подтверждением и  сгенерировано автоматически. Отвечать на него не нужно.\n\nСпасибо за внимание к нашему проекту.";
//
//				$mail_from = "info@cntis.ru";
//				$replyto = "Administrator";
//				$headers = "To: \"{$MAIL['CONTACT_PERSON']}\" <$mail_to>\r\n".
//				          "From: \"$replyto\" <$mail_from>\r\n".
//				          "Reply-To: $replyto\r\n".
//				          "Content-Type: text/$type; charset=\"$charset\"\r\n";
//				$sended = smtpmail($mail_to, $subject, $message, $headers);
//		   if (!$sended) {
//		   	$resultInfo["MESSAGE_TO_MNGR"]["result"] = false;
//		   	$resultInfo["MESSAGE_TO_MNGR"]["message"] = "<p >Сообщение не удалось отправить. Пожалуйста свяжитесь с администратором сайта по адресу: {$mail_to}</p>";
//		   }else{
//		   	$resultInfo["MESSAGE_TO_MNGR"]["result"] = true;
//		   	$resultInfo["MESSAGE_TO_MNGR"]["message"] = "<p class='headerGreen'>Уведомление отправлено по адресу: {$mail_to}</p>";
//	  	 }
//	  	 */
//	   	echo  "<p >Сообщение отправлено по адресу: {$mail_to}</p>";
//	   }
//	//Header('Location: mailer.html');
//	$_SESSION["MAIL"] = array();
//else:
//	$resultInfo["MESSAGE_REGISTR"]["result"] = false;
//	$resultInfo["MESSAGE_REGISTR"]["message"] = "<p >Результат формы не полон. Пожалуйста заполните форму еще раз. </p>";
//endif;
//
//$err = false;
//foreach ($resultInfo as $key => $val){
//	if($val["result"] === true){
//		$img = "plus";
//	}else{
//		$img = "minus";
//		$err = true;
//	}
//}
//
//if($err){
//	$ps = "<p>Ошибка в процедуре регистрации. Пожалуйста свяжитесь с менеджером по адресу: {$mail_to}";
//}else{
//	$ps = "<p class='headerGreen'>Спасибо за внимание к нашему проекту.";
//}
//echo $ps;
//
//}
?>



<?require($_SERVER["DOCUMENT_ROOT"]."/footer.php");?>
