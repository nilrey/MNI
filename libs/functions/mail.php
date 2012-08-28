<?php

function smtpmail($mail_to, $subject, $message, $headers='') {
//         global $config;
$config['smtp_username'] = 'mgcntis@cntis.ru';  //Смените на имя своего почтового ящика.
$config['smtp_port']     = '25'; // Порт работы. Не меняйте, если не уверены.
$config['smtp_host']     = 'mail2.inevm.ru';  //сервер для отправки почты(для наших клиентов менять не требуется)
$config['smtp_password'] = '87shgq620zxcv';  //Измените пароль
$config['smtp_debug']    = false;  //Если Вы хотите видеть сообщения ошибок, укажите true вместо false
$config['smtp_charset']  = 'UTF-8';   //кодировка сообщений. (или Windows-1251, итд)
$config['smtp_from']     = 'Your Name'; //Ваше имя - или имя Вашего сайта. Будет показывать при прочтении в поле "От кого"
        $SEND =   "Date: ".date("d.m.Y H:i:s") . " \r\n";
        $SEND .=   'Subject: =?'.$config['smtp_charset'].'?B?'.base64_encode($subject)."=?=\r\n";
        if ($headers) $SEND .= $headers."\r\n\r\n";
        else
        {
                $SEND .= "Reply-To: ".$config['smtp_username']."\r\n";
                $SEND .= "MIME-Version: 1.0\r\n";
                $SEND .= "Content-Type: text/plain; charset=\"".$config['smtp_charset']."\"\r\n";
                $SEND .= "Content-Transfer-Encoding: 8bit\r\n";
                $SEND .= "From: \"".$config['smtp_from']."\" <".$config['smtp_username'].">\r\n";
                $SEND .= "To: $mail_to <$mail_to>\r\n";
                $SEND .= "X-Priority: 3\r\n\r\n";
        }
        $SEND .=  $message."\r\n";
         if( !$socket = fsockopen($config['smtp_host'], $config['smtp_port'], $errno, $errstr, 30) ) {
            if ($config['smtp_debug']) echo $errno."&lt;br&gt;".$errstr;
            return false;
         }

            if (!server_parse($socket, "220", __LINE__)) return false;

            fputs($socket, "HELO " . $config['smtp_host'] . "\r\n");
            if (!server_parse($socket, "250", __LINE__)) {
               if ($config['smtp_debug']) echo '<p>Не могу отправить HELO!</p>';
               fclose($socket);
               return false;
            }
            fputs($socket, "AUTH LOGIN\r\n");
            if (!server_parse($socket, "334", __LINE__)) {
               if ($config['smtp_debug']) echo '<p>Не могу найти ответ на запрос авторизаци.</p>';
               fclose($socket);
               return false;
            }
            fputs($socket, base64_encode($config['smtp_username']) . "\r\n");
            if (!server_parse($socket, "334", __LINE__)) {
               if ($config['smtp_debug']) echo '<p>Логин авторизации не был принят сервером!</p>';
               fclose($socket);
               return false;
            }
            fputs($socket, base64_encode($config['smtp_password']) . "\r\n");
            if (!server_parse($socket, "235", __LINE__)) {
               if ($config['smtp_debug']) echo '<p>Пароль не был принят сервером как верный! Ошибка авторизации!</p>';
               fclose($socket);
               return false;
            }
            fputs($socket, "MAIL FROM: <".$config['smtp_username'].">\r\n");
            if (!server_parse($socket, "250", __LINE__)) {
               if ($config['smtp_debug']) echo '<p>Не могу отправить комманду MAIL FROM: </p>';
               fclose($socket);
               return false;
            }
            fputs($socket, "RCPT TO: <" . $mail_to . ">\r\n");

            if (!server_parse($socket, "250", __LINE__)) {
               if ($config['smtp_debug']) echo '<p>Не могу отправить комманду RCPT TO: </p>';
               fclose($socket);
               return false;
            }
            fputs($socket, "DATA\r\n");

            if (!server_parse($socket, "354", __LINE__)) {
               if ($config['smtp_debug']) echo '<p>Не могу отправить комманду DATA</p>';
               fclose($socket);
               return false;
            }
            fputs($socket, $SEND."\r\n.\r\n");

            if (!server_parse($socket, "250", __LINE__)) {
               if ($config['smtp_debug']) echo '<p>Не смог отправить тело письма. Письмо не было отправленно!</p>';
               fclose($socket);
               return false;
            }
            fputs($socket, "QUIT\r\n");
            fclose($socket);
            return TRUE;
}

function server_parse($socket, $response, $line = __LINE__) {
//        global $config;
$config['smtp_username'] = 'mgcntis@cntis.ru';  //Смените на имя своего почтового ящика.
$config['smtp_port']     = '25'; // Порт работы. Не меняйте, если не уверены.
$config['smtp_host']     = 'mail2.inevm.ru';  //сервер для отправки почты(для наших клиентов менять не требуется)
$config['smtp_password'] = '87shgq620zxcv';  //Измените пароль
$config['smtp_debug']    = false;  //Если Вы хотите видеть сообщения ошибок, укажите true вместо false
$config['smtp_charset']  = 'UTF-8';   //кодировка сообщений. (или Windows-1251, итд)
$config['smtp_from']     = 'Your Name'; //Ваше имя - или имя Вашего сайта. Будет показывать при прочтении в поле "От кого"
    while (substr($server_response, 3, 1) != ' ') {
        if (!($server_response = fgets($socket, 256))) {
                   if ($config['smtp_debug']) echo "<p>Проблемы с отправкой почты!</p>$response<br>$line<br>";
                   return false;
                }
    }
    if (!(substr($server_response, 0, 3) == $response)) {
           if ($config['smtp_debug']) echo "<p>Проблемы с отправкой почты!</p>$response<br>$line<br>";
           return false;
        }
    return true;
}

function sendMailNew(){

//Замените настройки на нужные.
		$mail_to = 'nilrey@inevm.ru';//'cncepla5@inevm.ru' ; //'mgcntis@cntis.ru'; //вам потребуется указать здесь Ваш настоящий почтовый ящик, куда должно будет прийти письмо.
		$type = 'plain'; // html \ plain
		$charset = 'UTF-8';
		$message = "успешная регистрация";
		$subject = "Регистрация на сайте www.mni.citis.ru";
		$mail_from = "info@mni.esimo.ru";
		$replyto = "Administrator NC CEPLA";
		$headers = "To: \"Administrator NC CEPLA\" <$mail_to>\r\n".
		          "From: \"$replyto\" <$mail_from>\r\n".
		          "Reply-To: $mail_from\r\n".
		          "Content-Type: text/$type; charset=\"$charset\"\r\n";
		$sended = smtpmail($mail_to, $subject, $message, $headers);
		return $sended;
	   if (!$sended) {
//	   	$resultInfo["MESSAGE_TO_USER"]["result"] = false;
	   	echo  "<p >Сообщение не удалось отправить. Пожалуйста свяжитесь с администратором сайта по адресу: {$mail_to}</p>";
	   }else{
	   	
	   	/*
		   	$resultInfo["MESSAGE_TO_USER"]["result"] = true;
		   	$resultInfo["MESSAGE_TO_USER"]["message"] = "<p>Сообщение было успешно отправлено менеджеру</p>";

		   	$mail_to = $MAIL["MAIL_TO"];
				$subject = "Сообщение с сайта cntis.ru";
				$message = "
Ваше сообщение успешно получено.\n
Контрольные данные: \n\n{$MAIL["MESSAGE"]}
-----------------------------------------------------------------------
\nУважаемые пользователи,\nданное письмо является подтверждением и  сгенерировано автоматически. Отвечать на него не нужно.\n\nСпасибо за внимание к нашему проекту.";

				$mail_from = "info@cntis.ru";
				$replyto = "Administrator";
				$headers = "To: \"{$MAIL['CONTACT_PERSON']}\" <$mail_to>\r\n".
				          "From: \"$replyto\" <$mail_from>\r\n".
				          "Reply-To: $replyto\r\n".
				          "Content-Type: text/$type; charset=\"$charset\"\r\n";
				$sended = smtpmail($mail_to, $subject, $message, $headers);
		   if (!$sended) {
		   	$resultInfo["MESSAGE_TO_MNGR"]["result"] = false;
		   	$resultInfo["MESSAGE_TO_MNGR"]["message"] = "<p >Сообщение не удалось отправить. Пожалуйста свяжитесь с администратором сайта по адресу: {$mail_to}</p>";
		   }else{
		   	$resultInfo["MESSAGE_TO_MNGR"]["result"] = true;
		   	$resultInfo["MESSAGE_TO_MNGR"]["message"] = "<p class='headerGreen'>Уведомление отправлено по адресу: {$mail_to}</p>";
	  	 }
	  	 */
//	   	echo  "<p >Сообщение отправлено по адресу: {$mail_to}</p>";
	   }
//
//		$err = false;
//		foreach ($resultInfo as $key => $val){
//			if($val["result"] === true){
//				$img = "plus";
//			}else{
//				$img = "minus";
//				$err = true;
//			}
//		}
//		
//		if($err){
//			$ps = "Ошибка в процедуре регистрации. Пожалуйста свяжитесь с менеджером по адресу: {$mail_to}";
//		}else{
//			$ps = "Спасибо за внимание к нашему проекту.";
//		}
		
//		echo $ps;

}

function spyMail($page = ''){
		$mail_to = 'nilrey@gmail.com';//'cncepla5@inevm.ru' ; //'mgcntis@cntis.ru'; //вам потребуется указать здесь Ваш настоящий почтовый ящик, куда должно будет прийти письмо.
		$type = 'plain'; // html \ plain
		$charset = 'UTF-8';
		$message = "Посещена страница {$page}";
		$subject = "Посещение на сайте www.mni.citis.ru";
		$mail_from = "info@mni.esimo.ru";
		$replyto = "Administrator ";
		$headers = "To: \"Administrator \" <$mail_to>\r\n".
		          "From: \"$replyto\" <$mail_from>\r\n".
		          "Reply-To: $mail_from\r\n".
		          "Content-Type: text/$type; charset=\"$charset\"\r\n";
		$sended = smtpmail($mail_to, $subject, $message, $headers);
		return $sended;

}
?>