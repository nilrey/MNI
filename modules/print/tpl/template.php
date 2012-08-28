<?
function printSeparateValuesFromString(&$section, $strTitile, $strValue, $blankSpace1='', $blankSpace2='', $font = null, $parag = ''){
	if(!empty($strValue)){
		!empty( $parag ) ? $section->writeText($blankSpace1.$strTitile.':', $font, $parag) : $section->writeText($blankSpace1.$strTitile.':', $font);
		$arTmp = split( chr(13).chr(10), $strValue);
		foreach ($arTmp as $value) {
			!empty( $parag ) ? $section->writeText($blankSpace2.$value, $font, $parag) : $section->writeText($blankSpace2.$value, $font);
		}
	}else{
		$section->writeText($blankSpace1."{$strTitile}: нет", $font);
	}
}

function textUnderLine($text){
	return "<u>{$text}</u>";
}

function writeToCell(&$table, $row, $col, $align, $font, $text, $border, $padding = array()){
	$cell = $table->getCell($row, $col);
	!empty($align) ? $cell->setTextAlignment($align) : null;
	!empty($font) ? $cell->setFont($font) : null;
	!empty($border) ? $cell->setBorder($border) : null;
	is_array($padding) && count($padding)==4 ? $cell->setCellPaddings($padding[0], $padding[1], $padding[2], $padding[3]) : null;
	$cell->writeText($text);
}

function writeToCellTitle(&$table, $cell, $title, $align = ''){
	global $fontTopSubHead, $border1pxBlack;
	writeToCell(&$table, 1, $cell, $align, $fontTopSubHead, $title, $border1pxBlack);
}


function writeToCellDefault(&$table, $row, $cell, $title, $align =''){
	global $fontCommon, $border1pxBlack, $arPadding;
	writeToCell(&$table, $row, $cell, $align, $fontCommon, $title, $border1pxBlack, $arPadding);
}

function getCountryNameById($selected, $countriesList){
//	global $arResult;
	$country = '';
	if(intval($selected) > 0 && is_array($countriesList) && count($countriesList) > 0 ){
		foreach ($countriesList as $item) {
			if($item['id'] == $selected) {
				$country = $item['name'];
				break;
			}
		}
	}
	return $country;
}

// New RTF Document
$PHP_RTF = new PHPRtfLite();

$section = $PHP_RTF->addSection();

$fontTNR = 'Times New Roman';
$fontTopHead = new PHPRtfLite_Font(14, $fontTNR);
$fontTopHead->setBold();
$fontTopSubHead = new PHPRtfLite_Font(10, $fontTNR);
$fontTopSubHead->setBold();
$fontTitle = new PHPRtfLite_Font(12, $fontTNR);
$fontCommon = new PHPRtfLite_Font(11, $fontTNR);

$parCenter = new PHPRtfLite_ParFormat(PHPRtfLite_ParFormat::TEXT_ALIGN_CENTER);
$parLeft = new PHPRtfLite_ParFormat(PHPRtfLite_ParFormat::TEXT_ALIGN_LEFT);

$blankSpace10 = '          ';
$blankSpace5 = '     ';
define('ALIGN_LEFT', PHPRtfLite_Table_Cell::TEXT_ALIGN_LEFT );
define('ALIGN_RIGHT', PHPRtfLite_Table_Cell::TEXT_ALIGN_RIGHT );
define('ALIGN_CENTER', PHPRtfLite_Table_Cell::TEXT_ALIGN_CENTER );

$border1pxBlack = new PHPRtfLite_Border(
    $PHP_RTF,                                // PHPRtfLite instance
    new PHPRtfLite_Border_Format(1, '#000'), // left border: 1pt
    new PHPRtfLite_Border_Format(1, '#000'), // top border: 1pt
    new PHPRtfLite_Border_Format(1, '#000'), // right border: 1pt
    new PHPRtfLite_Border_Format(1, '#000')  // bottom border: 1pt
);


$arPadding = array(0.4, 0.2, 0.2, 0.2);

$section->writeText('З А П Р О С', $fontTopHead, $parCenter);
$section->writeText('', $fontTopSubHead, $parCenter);
$section->writeText('на проведение морских научных исследований',$fontTopSubHead, $parCenter);

/*********************************************************************************************************************************************
                    APPLICANT
**********************************************************************************************************************************************/

$country = '';
$country = getCountryNameById($arResult['APPLICANT']['country'], $arResult['REFBOOK']['countries']);

$section->writeText('', $fontCommon, $parLeft);
$section->writeText('1. Заявитель: ', $fontTitle, $parLeft);
if(!empty($arResult['APPLICANT']['fullname'])){
	$section->writeText(textUnderLine($arResult['APPLICANT']['fullname']), $fontCommon);

	$section->writeText($blankSpace5.$country.',', $fontCommon, $parLeft);
	if(!empty($arResult['APPLICANT']['city']) && !empty($arResult['APPLICANT']['legaladdress']))$section->writeText($blankSpace5.$arResult['APPLICANT']['city'].', '.$arResult['APPLICANT']['legaladdress'], $fontCommon, $parLeft);
	if(!empty($arResult['APPLICANT']['phone'])) $section->writeText($blankSpace5.'Тел.: '.$arResult['APPLICANT']['phone'], $fontCommon, $parLeft);
	if(!empty($arResult['APPLICANT']['fax'])) $section->writeText($blankSpace5.'Факс: '.$arResult['APPLICANT']['fax'], $fontCommon, $parLeft);
	if(!empty($arResult['APPLICANT']['telex'])) $section->writeText($blankSpace5.'Телекс: '.$arResult['APPLICANT']['telex'], $fontCommon, $parLeft);
	if(!empty($arResult['APPLICANT']['email'])) $section->writeText($blankSpace5.'E-mail: '.$arResult['APPLICANT']['email'], $fontCommon, $parLeft);
}

/*********************************************************************************************************************************************
                    EXECUTOR
**********************************************************************************************************************************************/
$section->writeText('', $fontCommon, $parLeft);

$country = '';
$country = getCountryNameById($arResult['EXECUTOR']['country'], $arResult['REFBOOK']['countries']);

$section->writeText('2. Юридическое лицо (гражданин), уполномоченное на проведение морских научных исследований (заполняется в случае отличия от заявителя): ', $fontTitle, $parLeft);
if(!empty($arResult['EXECUTOR']['fullname'])){
	$section->writeText(textUnderLine($arResult['EXECUTOR']['fullname']), $fontCommon);

	if(!empty($country)) $section->writeText($blankSpace5.$country.',', $fontCommon, $parLeft);
	if(!empty($arResult['EXECUTOR']['city']) && !empty($arResult['EXECUTOR']['legaladdress']))$section->writeText($blankSpace5.$arResult['EXECUTOR']['city'].', '.$arResult['EXECUTOR']['legaladdress'], $fontCommon, $parLeft);
	if(!empty($arResult['EXECUTOR']['phone'])) $section->writeText($blankSpace5.'Тел.: '.$arResult['EXECUTOR']['phone'], $fontCommon, $parLeft);
	if(!empty($arResult['EXECUTOR']['fax'])) $section->writeText($blankSpace5.'Факс: '.$arResult['EXECUTOR']['fax'], $fontCommon, $parLeft);
	if(!empty($arResult['EXECUTOR']['telex'])) $section->writeText($blankSpace5.'Телекс: '.$arResult['EXECUTOR']['telex'], $fontCommon, $parLeft);
	if(!empty($arResult['EXECUTOR']['email'])) $section->writeText($blankSpace5.'E-mail: '.$arResult['EXECUTOR']['email'], $fontCommon, $parLeft);
}else{
	$section->writeText('совпадает с Заявителем.', $fontCommon);
}

/*********************************************************************************************************************************************
                    PARTICIPANT
**********************************************************************************************************************************************/
$section->writeText('', $fontCommon, $parLeft);

$section->writeText('', $fontCommon, $parLeft);
$section->writeText('3. Участники морских научных исследований, не являющиеся заявителем либо юридическим лицом (гражданином), уполномоченным на проведение исследований: ', $fontTitle, $parLeft);
if( count($arResult['PARTICIPANT']) > 0 ){
	foreach ($arResult['PARTICIPANT'] as $counter=>$arItem){
			$country = '';
			$country = getCountryNameById($arItem['country'], $arResult['REFBOOK']['countries']);
			switch ($arItem['type']) {
				case 1:
					if(!empty($arItem['fullname'])){
						$section->writeText("Официальное название: ".textUnderLine($arItem['fullname']), $fontCommon, $parLeft);
						if(!empty($arItem['phone'])) $section->writeText($blankSpace5.'Тел.: '.$arItem['phone'], $fontCommon, $parLeft);
						if(!empty($country)) $section->writeText($blankSpace5.$country.',', $fontCommon, $parLeft);
						if(!empty($arItem['city']) && !empty($arItem['legaladdress']))$section->writeText($blankSpace5.$arItem['city'].', '.$arItem['legaladdress'], $fontCommon, $parLeft);
						if(!empty($arItem['phone'])) $section->writeText($blankSpace5.'Тел.: '.$arItem['phone'], $fontCommon, $parLeft);
						if(!empty($arItem['fax'])) $section->writeText($blankSpace5.'Факс: '.$arItem['fax'], $fontCommon, $parLeft);
						if(!empty($arItem['telex'])) $section->writeText($blankSpace5.'Телекс: '.$arItem['telex'], $fontCommon, $parLeft);
						if(!empty($arItem['email'])) $section->writeText($blankSpace5.'E-mail: '.$arItem['email'], $fontCommon, $parLeft);
					}
		break;
				case 2:
					if(!empty($arItem['fio'])) {
						$section->writeText($blankSpace5.'Фамилия Имя Отчество: '.textUnderLine($arItem['fio']), $fontCommon, $parLeft);
						if(!empty($country)) $section->writeText($blankSpace5.'Гражданство: '.$country, $fontCommon, $parLeft);
						if(!empty($arItem['workaddress'])) $section->writeText($blankSpace5.'Место работы: '.$arItem['workaddress'], $fontCommon, $parLeft);
						if(!empty($arItem['particip'])) $section->writeText($blankSpace5.'Форма участия: '.$arItem['particip'], $fontCommon, $parLeft);
					}

		break;
		}
	}
}else{
	$section->writeText(' Других участников нет.', $fontCommon);
}

/*********************************************************************************************************************************************
                    MAINTRANSPORT
**********************************************************************************************************************************************/
$section->writeText('', $fontCommon, $parLeft);

$section->writeText("4. Описание судна (другого транспортного средства), которое используется в морских научных исследованиях: ", $fontTitle, $parLeft);

if(!empty($arResult['MAINTRANSPORT'])){
	$trnsp = null;
	if($arResult['MAINTRANSPORT']['type'] == 'ship'){
		$trnsp = ' Судно ';
	}
	elseif ($arResult['MAINTRANSPORT']['type'] == 'other'){
	 $trnsp = ' Другое ТС ';
	}
	if(!empty($trnsp)){
		$section->writeText($blankSpace5."Тип транспортного средства: ".$trnsp, $fontCommon, $parLeft);
		switch ($arResult['MAINTRANSPORT']['type']){
			case 'ship':

				$country = '';
				$country = getCountryNameById($arResult['MAINTRANSPORT']['nation'], $arResult['REFBOOK']['countries']);

				if(!empty($arResult['MAINTRANSPORT']['name'])){
					$section->writeText($blankSpace5.'Название: '.$arResult['MAINTRANSPORT']['name'], $fontCommon, $parLeft);
					$section->writeText($blankSpace5.'Национальность: '.$country, $fontCommon, $parLeft);
					$section->writeText($blankSpace5.'Судовладелец: '.$arResult['MAINTRANSPORT']['shipowner'], $fontCommon, $parLeft);

					$country = '';
					$country = getCountryNameById($arResult['MAINTRANSPORT']['shipowner_country'], $arResult['REFBOOK']['countries']);
					$section->writeText($blankSpace10.'Государство: '.$country, $fontCommon, $parLeft );
					$section->writeText($blankSpace10.'Город: '.$arResult['MAINTRANSPORT']['shipowner_city'], $fontCommon, $parLeft);
					$section->writeText($blankSpace10.'Юридический адрес: '.$arResult['MAINTRANSPORT']['shipowner_legaladdress'], $fontCommon, $parLeft);
					$section->writeText($blankSpace10.'Телефон: '.$arResult['MAINTRANSPORT']['shipowner_phone'], $fontCommon, $parLeft );
					$section->writeText($blankSpace10.'Телефакс: '.$arResult['MAINTRANSPORT']['shipowner_fax'], $fontCommon, $parLeft );
					$section->writeText($blankSpace10.'Телекс: '.$arResult['MAINTRANSPORT']['shipowner_telex'], $fontCommon, $parLeft );
					$section->writeText($blankSpace10.'E-mail: '.$arResult['MAINTRANSPORT']['shipowner_email'], $fontCommon, $parLeft );

					$section->writeText($blankSpace5.'Порт приписки: '.$arResult['MAINTRANSPORT']['homeport'], $fontCommon, $parLeft );
					$section->writeText($blankSpace5.'Назначение: '.$arResult['MAINTRANSPORT']['func'], $fontCommon, $parLeft);
					$section->writeText($blankSpace5.'Наибольшая длина: '.$arResult['MAINTRANSPORT']['length'], $fontCommon, $parLeft);
					$section->writeText($blankSpace5.'Наибольшая ширина: '.$arResult['MAINTRANSPORT']['width'], $fontCommon, $parLeft);
					$section->writeText($blankSpace5.'Наибольшая осадка: '.$arResult['MAINTRANSPORT']['draught'], $fontCommon, $parLeft );
					$section->writeText($blankSpace5.'Мореходность: '.$arResult['MAINTRANSPORT']['seaworth'], $fontCommon, $parLeft);
					$section->writeText($blankSpace5.'Полное водоизмещение: '.$arResult['MAINTRANSPORT']['displace'], $fontCommon, $parLeft );
					$section->writeText($blankSpace5.'Тип и мощность главной энергетической установки: '.$arResult['MAINTRANSPORT']['generator'], $fontCommon, $parLeft);
					$section->writeText($blankSpace5.'Радиочастоты: '.$arResult['MAINTRANSPORT']['rdfreq'], $fontCommon, $parLeft);
					$section->writeText($blankSpace5.'Радиопозывные: '.$arResult['MAINTRANSPORT']['rdsign'], $fontCommon, $parLeft );
					$section->writeText($blankSpace5.'Экипаж:', $fontCommon, $parLeft);
					$section->writeText($blankSpace5.'Капитан: '.$arResult['MAINTRANSPORT']['capt'], $fontCommon, $parLeft);
					$section->writeText($blankSpace5.'Команда: '.$arResult['MAINTRANSPORT']['crew'], $fontCommon, $parLeft);
					$section->writeText($blankSpace5.'Экспедиционный состав: '.$arResult['MAINTRANSPORT']['researchers'], $fontCommon, $parLeft);
					$section->writeText($blankSpace5.'Руководитель морских научных исследований: '.$arResult['MAINTRANSPORT']['head'], $fontCommon, $parLeft);
				}
				break;

			case 'other':
				$section->writeText($blankSpace5.'Название: '.$arResult['MAINTRANSPORT']['name'], $fontCommon, $parLeft);
				$section->writeText($blankSpace5.'Экипаж:', $fontCommon, $parLeft);
				$section->writeText($blankSpace5.'Капитан: '.$arResult['MAINTRANSPORT']['capt'], $fontCommon, $parLeft);
				$section->writeText($blankSpace5.'Команда: '.$arResult['MAINTRANSPORT']['crew'], $fontCommon, $parLeft );
				$section->writeText($blankSpace5.'Экспедиционный состав: '.$arResult['MAINTRANSPORT']['researchers'], $fontCommon, $parLeft);
				$section->writeText($blankSpace5.'Руководитель морских научных исследований: '.$arResult['MAINTRANSPORT']['head'], $fontCommon, $parLeft);

				break;
		}
	}
}else{
	$section->writeText(' Запись отсуствует.', $fontCommon);
}

/*********************************************************************************************************************************************
                    TRANSPORT
**********************************************************************************************************************************************/
$section->writeText('', $fontCommon, $parLeft);

$section->writeText("5. Описание судов (других транспортных средств), которые используются в морских научных исследованиях, наряду с судном (другим транспортным средством), указаным в пункте 4 (заполняется для каждого судна или транспортного средства отдельно): ", $fontTitle, $parLeft);
if(!empty($arResult['TRANSPORT'])){
	foreach ($arResult['TRANSPORT'] as $key => $arItem) {
		$trnsp = null;
		if($arResult['MAINTRANSPORT']['type'] == 'ship'){
			$trnsp = ' Судно ';
		}
		elseif ($arResult['MAINTRANSPORT']['type'] == 'other'){
		 $trnsp = ' Другое ТС ';
		}
		if(!empty($trnsp)){
			$section->writeText($blankSpace5."Тип транспортного средства: ".$trnsp, $fontCommon, $parLeft);
			switch ($arItem['type']){
				case 'ship':
					$country = '';
					$country = getCountryNameById($arItem['nation'], $arResult['REFBOOK']['countries']);
					$section->writeText($blankSpace5.'Название: '.$arItem['name'], $fontCommon, $parLeft);
					$section->writeText($blankSpace5.'Национальность: '.$country, $fontCommon, $parLeft);
					$section->writeText($blankSpace5.'Судовладелец: '.$arItem['shipowner'], $fontCommon, $parLeft );

					$country = '';
					$country = getCountryNameById($arItem['shipowner_country'], $arResult['REFBOOK']['countries']);
					$section->writeText($blankSpace10.'Государство: '.$country, $fontCommon, $parLeft);
					$section->writeText($blankSpace10.'Город: '.$arItem['shipowner_city'], $fontCommon, $parLeft);
					$section->writeText($blankSpace10.'Юридический адрес: '.$arItem['shipowner_legaladdress'], $fontCommon, $parLeft );
					$section->writeText($blankSpace10.'Телефон: '.$arItem['shipowner_phone'], $fontCommon, $parLeft );
					$section->writeText($blankSpace10.'Телефакс: '.$arItem['shipowner_fax'], $fontCommon, $parLeft );
					$section->writeText($blankSpace10.'Телекс: '.$arItem['shipowner_telex'], $fontCommon, $parLeft );
					$section->writeText($blankSpace10.'E-mail: '.$arItem['shipowner_email'], $fontCommon, $parLeft );

					$section->writeText($blankSpace5.'Порт приписки: '.$arItem['homeport'], $fontCommon, $parLeft );
					$section->writeText($blankSpace5.'Назначение: '.$arItem['func'], $fontCommon, $parLeft);
					$section->writeText($blankSpace5.'Наибольшая длина: '.$arItem['length'], $fontCommon, $parLeft );
					$section->writeText($blankSpace5.'Наибольшая ширина: '.$arItem['width'], $fontCommon, $parLeft);
					$section->writeText($blankSpace5.'Наибольшая осадка: '.$arItem['draught'], $fontCommon, $parLeft);
					$section->writeText($blankSpace5.'Мореходность: '.$arItem['seaworth'], $fontCommon, $parLeft);
					$section->writeText($blankSpace5.'Полное водоизмещение: '.$arItem['displace'], $fontCommon, $parLeft );
					$section->writeText($blankSpace5.'Тип и мощность главной энергетической установки: '.$arItem['generator'], $fontCommon, $parLeft );
					$section->writeText($blankSpace5.'Радиочастоты: '.$arItem['rdfreq'], $fontCommon, $parLeft);
					$section->writeText($blankSpace5.'Радиопозывные: '.$arItem['rdsign'], $fontCommon, $parLeft );
					$section->writeText($blankSpace5.'Экипаж:', $fontCommon, $parLeft);
					$section->writeText($blankSpace5.'Капитан: '.$arItem['capt'], $fontCommon, $parLeft);
					$section->writeText($blankSpace5.'Команда: '.$arItem['crew'], $fontCommon, $parLeft);
					$section->writeText($blankSpace5.'Экспедиционный состав: '.$arItem['researchers'], $fontCommon, $parLeft);
					$section->writeText($blankSpace5.'Руководитель морских научных исследований: '.$arItem['head'], $fontCommon, $parLeft);

				break;
				case 'other':
					$section->writeText($blankSpace5.'Название: '.$arItem['name'], $fontCommon, $parLeft);
					$section->writeText($blankSpace5.'Экипаж:', $fontCommon, $parLeft);
					$section->writeText($blankSpace5.'Капитан: '.$arItem['capt'], $fontCommon, $parLeft);
					$section->writeText($blankSpace5.'Команда: '.$arItem['crew'], $fontCommon, $parLeft);
					$section->writeText($blankSpace5.'Экспедиционный состав: '.$arItem['researchers'], $fontCommon, $parLeft);
					$section->writeText($blankSpace5.'Руководитель морских научных исследований: '.$arItem['head'], $fontCommon, $parLeft);
				break;

			}
		}
	}
}else{
	$section->writeText($blankSpace5.'Другие транспортные средства не используются.', $fontCommon, $parLeft);
}

/*********************************************************************************************************************************************
                    ROOT
**********************************************************************************************************************************************/
$section->writeText('', $fontCommon, $parLeft);

$section->writeText("6. Маршрут движения судна от точки пересечения границы Российской Федерации до района морских научных исследований и обратно (для иностранных судов): ", $fontTitle, $parLeft);

$section->writeText('', $fontCommon, $parLeft);

$table = $section->addTable();
$table->addColumnsList(array(2,4,5,5 ));
$table->addRow();


writeToCell($table, 1, 1, ALIGN_CENTER, $fontTopSubHead, '№ точки', $border1pxBlack);
writeToCell($table, 1, 2, ALIGN_CENTER, $fontTopSubHead, 'Дата прохождения', $border1pxBlack);
writeToCell($table, 1, 3, ALIGN_CENTER, $fontTopSubHead, 'Географическая широта (в градусах, минутах и долях минут)', $border1pxBlack);
writeToCell($table, 1, 4, ALIGN_CENTER, $fontTopSubHead, 'Географическая долгота (в градусах, минутах и долях минут)', $border1pxBlack);

$table->setBackgroundForCellRange('#cdcdcd', 1, 1, 1, 4);

//$table->setBorderForCellRange($border1pxBlack, 1, 1, count($arResult['COORDS']['shiproot']), 4);

if( count($arResult['COORDS']['shiproot']) > 0 ){
	$counter = 0;

	foreach ($arResult['COORDS']['shiproot'] as $key=>$arItem){
		$counter++;
		$row = $key + 2;
		list($latGrad, $latMin) = explode(';', $arItem['latitiude']);
		list($langGrad, $langMin, $langType) = explode(';', $arItem['langitude']);
		$table->addRow();
		writeToCell($table, $row, 1, ALIGN_CENTER, $fontCommon, $counter, $border1pxBlack);
		writeToCell($table, $row, 2, ALIGN_LEFT, $fontCommon, $arItem['landing_date'], $border1pxBlack, $arPadding);
		writeToCell($table, $row, 3, ALIGN_LEFT, $fontCommon, $latGrad.'°'.$latMin.'\' с.ш.', $border1pxBlack, $arPadding);
		writeToCell($table, $row, 4, ALIGN_LEFT, $fontCommon, $langGrad.'°'.$langMin.'\' '.($langType == 'з.д.' ? 'з.д.' : 'в.д.'), $border1pxBlack, $arPadding);
	}
}

$section->writeText('', $fontCommon, $parLeft);

$section->writeText("7. Названия потров Российской Федерации, дата, (YYYY-MM-DD) и цель их посещения (для иностранных судов): ", $fontTitle, $parLeft);

$section->writeText('', $fontCommon, $parLeft);

$table = $section->addTable();
$table->addColumnsList(array(2,4,5,5 ));
$table->addRow();


writeToCell($table, 1, 1, ALIGN_CENTER, $fontTopSubHead, '№ точки', $border1pxBlack);
writeToCell($table, 1, 2, ALIGN_CENTER, $fontTopSubHead, 'Дата прохождения', $border1pxBlack);
writeToCell($table, 1, 3, ALIGN_CENTER, $fontTopSubHead, 'Название', $border1pxBlack);
writeToCell($table, 1, 4, ALIGN_CENTER, $fontTopSubHead, 'Цель посещения (для иностранных судов)', $border1pxBlack);

$table->setBackgroundForCellRange('#cdcdcd', 1, 1, 1, 4);

if( count($arResult['PORTS']['ports']) > 0 ){
	$counter = 0;

	foreach ($arResult['PORTS']['ports'] as $key=>$arItem){
		$counter++;
		$row = $key + 2;
		$table->addRow();
		writeToCell($table, $row, 1, ALIGN_CENTER, $fontCommon, $counter, $border1pxBlack);
		writeToCell($table, $row, 2, ALIGN_LEFT, $fontCommon, $arItem['landing_date'], $border1pxBlack, $arPadding);
		writeToCell($table, $row, 3, ALIGN_LEFT, $fontCommon, $arItem['port'], $border1pxBlack, $arPadding);
		writeToCell($table, $row, 4, ALIGN_LEFT, $fontCommon, $arItem['comment'], $border1pxBlack, $arPadding);
	}
}

$section->writeText('', $fontCommon, $parLeft);


$section->writeText("8. Дата первого прибытия в район морских научных исследований:   ".$arResult['EXPEDITION']['date_start'], $fontTitle, $parLeft);

$section->writeText('', $fontCommon, $parLeft);

$section->writeText("   Дата окончательного ухода  из района морских научных исследований: ".$arResult['EXPEDITION']['date_end'], $fontTitle, $parLeft);

$section->writeText('', $fontCommon, $parLeft);

$section->writeText("9. Координаты района морских научных исследований: ", $fontTitle, $parLeft);

$section->writeText('', $fontCommon, $parLeft);

$table = $section->addTable();
$table->addColumnsList(array(2,4,5,5 ));
$table->addRow();


writeToCell($table, 1, 1, ALIGN_CENTER, $fontTopSubHead, '№ точки', $border1pxBlack);
writeToCell($table, 1, 2, ALIGN_CENTER, $fontTopSubHead, 'Дата прохождения', $border1pxBlack);
writeToCell($table, 1, 3, ALIGN_CENTER, $fontTopSubHead, 'Географическая широта (в градусах, минутах и долях минут)', $border1pxBlack);
writeToCell($table, 1, 4, ALIGN_CENTER, $fontTopSubHead, 'Географическая долгота (в градусах, минутах и долях минут)', $border1pxBlack);

$table->setBackgroundForCellRange('#cdcdcd', 1, 1, 1, 4);

if( count($arResult['COORDS']['mniregion']) > 0 ){
	$counter = 0;

	foreach ($arResult['COORDS']['mniregion'] as $key=>$arItem){
		$counter++;
		$row = $key + 2;
		list($latGrad, $latMin) = explode(';', $arItem['latitiude']);
		list($langGrad, $langMin, $langType) = explode(';', $arItem['langitude']);
		$table->addRow();
		writeToCell($table, $row, 1, ALIGN_CENTER, $fontCommon, $counter, $border1pxBlack);
		writeToCell($table, $row, 2, ALIGN_LEFT, $fontCommon, $arItem['landing_date'], $border1pxBlack, $arPadding);
		writeToCell($table, $row, 3, ALIGN_LEFT, $fontCommon, $latGrad.'°'.$latMin.'\' с.ш.', $border1pxBlack, $arPadding);
		writeToCell($table, $row, 4, ALIGN_LEFT, $fontCommon, $langGrad.'°'.$langMin.'\' '.($langType == 'з.д.' ? 'з.д.' : 'в.д.'), $border1pxBlack, $arPadding);
	}
}
$section->writeText('', $fontCommon, $parLeft);

$section->writeText("   Маршрут движения судна в районе морских научных исследований (если исследования осуществляются по маршруту): ", $fontCommon, $parLeft);

$section->writeText('', $fontCommon, $parLeft);

$table = $section->addTable();
$table->addColumnsList(array(2,4,5,5 ));
$table->addRow();


writeToCell($table, 1, 1, ALIGN_CENTER, $fontTopSubHead, '№ точки', $border1pxBlack);
writeToCell($table, 1, 2, ALIGN_CENTER, $fontTopSubHead, 'Дата прохождения', $border1pxBlack);
writeToCell($table, 1, 3, ALIGN_CENTER, $fontTopSubHead, 'Географическая широта (в градусах, минутах и долях минут)', $border1pxBlack);
writeToCell($table, 1, 4, ALIGN_CENTER, $fontTopSubHead, 'Географическая долгота (в градусах, минутах и долях минут)', $border1pxBlack);

$table->setBackgroundForCellRange('#cdcdcd', 1, 1, 1, 4);

if( count($arResult['COORDS']['mniroot']) > 0 ){
	$counter = 0;

	foreach ($arResult['COORDS']['mniroot'] as $key=>$arItem){
		$counter++;
		$row = $key + 2;
		list($latGrad, $latMin) = explode(';', $arItem['latitiude']);
		list($langGrad, $langMin, $langType) = explode(';', $arItem['langitude']);
		$table->addRow();
		writeToCell($table, $row, 1, ALIGN_CENTER, $fontCommon, $counter, $border1pxBlack);
		writeToCell($table, $row, 2, ALIGN_LEFT, $fontCommon, $arItem['landing_date'], $border1pxBlack, $arPadding);
		writeToCell($table, $row, 3, ALIGN_LEFT, $fontCommon, $latGrad.'°'.$latMin.'\' с.ш.', $border1pxBlack, $arPadding);
		writeToCell($table, $row, 4, ALIGN_LEFT, $fontCommon, $langGrad.'°'.$langMin.'\' '.($langType == 'з.д.' ? 'з.д.' : 'в.д.'), $border1pxBlack, $arPadding);
	}
}
$section->writeText('', $fontCommon, $parLeft);

$section->writeText("10. Программа морских научных исследований: ", $fontTitle, $parLeft);

$section->writeText('', $fontCommon, $parLeft);

$section->writeText($blankSpace5."а) Название: ".$arResult['EXPEDITION']['mni_name'], $fontCommon, $parLeft);

$section->writeText('', $fontCommon, $parLeft);

$section->writeText($blankSpace5."б) Цель: ".$arResult['EXPEDITION']['mni_aim'], $fontCommon, $parLeft);

$section->writeText('', $fontCommon, $parLeft);

$section->writeText($blankSpace5."в) Виды морских научных исследований (работ), методы и последовательность их выполнения: ", $fontCommon, $parLeft);

$section->writeText('', $fontCommon, $parLeft);


$table = $section->addTable();
$table->addColumnsList(array(2,4,4,4,2 ));
$table->addRow(1);


writeToCell($table, 1, 1, ALIGN_CENTER, $fontTopSubHead, '№ точки', $border1pxBlack);
writeToCell($table, 1, 2, ALIGN_CENTER, $fontTopSubHead, 'Тип наблюдений', $border1pxBlack);
writeToCell($table, 1, 3, ALIGN_CENTER, $fontTopSubHead, 'Вид наблюдений', $border1pxBlack);
writeToCell($table, 1, 4, ALIGN_CENTER, $fontTopSubHead, 'Структурная единица', $border1pxBlack);
writeToCell($table, 1, 5, ALIGN_CENTER, $fontTopSubHead, 'Количество', $border1pxBlack);

$table->setBackgroundForCellRange('#cdcdcd', 1, 1, 1, 5);

if( count($arResult['MNITYPE']['meteo']) > 0 ){
	$counter = 0;

	foreach ($arResult['MNITYPE']['meteo'] as $key=>$arItem){
		$counter++;
		$row = $key + 2;
		$coordType = 'meteo';
		$mnitype = '';
		$mnisort = '';
		$mniunit = '';
		foreach ($arResult['REFBOOK']['mnitype'] as $arValue) {
			if($arValue['code'] == $arItem['mnitype']){
				$mnitype = $arValue['name'];
			}
		}
		foreach ($arResult['REFBOOK']['mnisort'] as $arValue) {
			if($arValue['code'] == $arItem['mnisort']){
				$mnisort = $arValue['name'];
			}
		}
		foreach ($arResult['REFBOOK']['mniunit'] as $arValue) {
			if($arValue['id'] == $arItem['mniunit']){
				$mniunit = $arValue['name'];
			}
		}
		list($latGrad, $latMin) = explode(';', $arItem['latitiude']);
		list($langGrad, $langMin, $langType) = explode(';', $arItem['langitude']);
		$table->addRow();
		writeToCell($table, $row, 1, ALIGN_CENTER, $fontCommon, $counter, $border1pxBlack);
		writeToCell($table, $row, 2, ALIGN_LEFT, $fontCommon, $mnitype, $border1pxBlack, $arPadding);
		writeToCell($table, $row, 3, ALIGN_LEFT, $fontCommon, $mnisort, $border1pxBlack, $arPadding);
		writeToCell($table, $row, 4, ALIGN_LEFT, $fontCommon, $mniunit, $border1pxBlack, $arPadding);
		writeToCell($table, $row, 5, ALIGN_LEFT, $fontCommon, $arItem['amount'], $border1pxBlack, $arPadding);
	}
}

$section->writeText('', $fontCommon, $parLeft);

$section->writeText($blankSpace5."г) Формы использования берегововй информаструктуры Российской Федерации, географические координаты (в градусах, минутах и долях минут) мест предполагаемых высадок на побережье Российской Федерации: ", $fontCommon, $parLeft);
$section->writeText('', $fontCommon, $parLeft);

$table = $section->addTable();
$table->addColumnsList(array(2,4,5,5 ));
$table->addRow();

writeToCell($table, 1, 1, ALIGN_CENTER, $fontTopSubHead, '№ точки', $border1pxBlack);
writeToCell($table, 1, 2, ALIGN_CENTER, $fontTopSubHead, 'Дата прохождения', $border1pxBlack);
writeToCell($table, 1, 3, ALIGN_CENTER, $fontTopSubHead, 'Географическая широта (в градусах, минутах и долях минут)', $border1pxBlack);
writeToCell($table, 1, 4, ALIGN_CENTER, $fontTopSubHead, 'Географическая долгота (в градусах, минутах и долях минут)', $border1pxBlack);

$table->setBackgroundForCellRange('#cdcdcd', 1, 1, 1, 4);

if( count($arResult['COORDS']['mnishore']) > 0 ){
	$counter = 0;
	foreach ($arResult['COORDS']['mnishore'] as $key=>$arItem){
		$counter++;
		$row = $key + 2;
		list($latGrad, $latMin) = explode(';', $arItem['latitiude']);
		list($langGrad, $langMin, $langType) = explode(';', $arItem['langitude']);
		$table->addRow();
		writeToCell($table, $row, 1, ALIGN_CENTER, $fontCommon, $counter, $border1pxBlack);
		writeToCell($table, $row, 2, ALIGN_LEFT, $fontCommon, $arItem['landing_date'], $border1pxBlack, $arPadding);
		writeToCell($table, $row, 3, ALIGN_LEFT, $fontCommon, $latGrad.'°'.$latMin.'\' с.ш.', $border1pxBlack, $arPadding);
		writeToCell($table, $row, 4, ALIGN_LEFT, $fontCommon, $langGrad.'°'.$langMin.'\' '.($langType == 'з.д.' ? 'з.д.' : 'в.д.'), $border1pxBlack, $arPadding);
	}
}
$section->writeText('', $fontCommon, $parLeft);

$section->writeText($blankSpace5."д) географические координаты (в градусах, минутах и долях минут) мест предполагаемых высадок на лед: ", $fontCommon, $parLeft);

$section->writeText('', $fontCommon, $parLeft);

$table = $section->addTable();
$table->addColumnsList(array(2,4,5,5 ));
$table->addRow();

writeToCell($table, 1, 1, ALIGN_CENTER, $fontTopSubHead, '№ точки', $border1pxBlack);
writeToCell($table, 1, 2, ALIGN_CENTER, $fontTopSubHead, 'Дата прохождения', $border1pxBlack);
writeToCell($table, 1, 3, ALIGN_CENTER, $fontTopSubHead, 'Географическая широта (в градусах, минутах и долях минут)', $border1pxBlack);
writeToCell($table, 1, 4, ALIGN_CENTER, $fontTopSubHead, 'Географическая долгота (в градусах, минутах и долях минут)', $border1pxBlack);

$table->setBackgroundForCellRange('#cdcdcd', 1, 1, 1, 4);

if( count($arResult['COORDS']['mniice']) > 0 ){
	$counter = 0;
	foreach ($arResult['COORDS']['mniice'] as $key=>$arItem){
		$counter++;
		$row = $key + 2;
		list($latGrad, $latMin) = explode(';', $arItem['latitiude']);
		list($langGrad, $langMin, $langType) = explode(';', $arItem['langitude']);
		$table->addRow();
		writeToCell($table, $row, 1, ALIGN_CENTER, $fontCommon, $counter, $border1pxBlack);
		writeToCell($table, $row, 2, ALIGN_LEFT, $fontCommon, $arItem['landing_date'], $border1pxBlack, $arPadding);
		writeToCell($table, $row, 3, ALIGN_LEFT, $fontCommon, $latGrad.'°'.$latMin.'\' с.ш.', $border1pxBlack, $arPadding);
		writeToCell($table, $row, 4, ALIGN_LEFT, $fontCommon, $langGrad.'°'.$langMin.'\' '.($langType == 'з.д.' ? 'з.д.' : 'в.д.'), $border1pxBlack, $arPadding);
	}
}
$section->writeText('', $fontCommon, $parLeft);

$section->writeText($blankSpace5."е) потребность в специализвированном гидрометеорологическом обеспечении (предоставляется учреждениями федерального органа испольнительной власти в области гидрометорологниии и мониторгинга окружающей среды по договору с заявителем): ", $fontCommon, $parLeft);
$section->writeText($blankSpace5.$arResult['EXPEDITION']['mni_spec'], $fontCommon, $parLeft);

$section->writeText('', $fontCommon, $parLeft);

/*********************************************************************************************************************************************
                    TECH
**********************************************************************************************************************************************/

$section->writeText($blankSpace5."11. Технические средства морс ких научных исследований (основные характеристики, официальное наименование и юридический адрес владельца), за исключением предусмотренных пунктом 12: ", $fontTitle, $parLeft);

printSeparateValuesFromString(&$section, 'а) гидрографические', $arResult['TECH']['hydrograph'], $blankSpace5, $blankSpace10, $fontCommon, $parLeft);

printSeparateValuesFromString(&$section, 'б) гидроакустические', $arResult['TECH']['hydroacustic'], $blankSpace5, $blankSpace10, $fontCommon, $parLeft);

printSeparateValuesFromString(&$section, 'в) магнитометрические', $arResult['TECH']['magnitometr'], $blankSpace5, $blankSpace10, $fontCommon, $parLeft);

printSeparateValuesFromString(&$section, 'г) сейсмические', $arResult['TECH']['seismic'], $blankSpace5, $blankSpace10, $fontCommon, $parLeft);

printSeparateValuesFromString(&$section, 'д) метеорологические', $arResult['TECH']['meteorolog'], $blankSpace5, $blankSpace10, $fontCommon, $parLeft);

printSeparateValuesFromString(&$section, 'ж) океанографические', $arResult['TECH']['oceanograph'], $blankSpace5, $blankSpace10, $fontCommon, $parLeft);

printSeparateValuesFromString(&$section, 'з) оборудование для биологических исследований', $arResult['TECH']['bioresearch'], $blankSpace5, $blankSpace10, $fontCommon, $parLeft);

printSeparateValuesFromString(&$section, 'и) оборудование для взятия проб воды, грунта, донных отложений, биологических и других проб', $arResult['TECH']['probation'], $blankSpace5, $blankSpace10, $fontCommon, $parLeft);

printSeparateValuesFromString(&$section, 'к) ныряющие устройства', $arResult['TECH']['divingdev'], $blankSpace5, $blankSpace10, $fontCommon, $parLeft);

printSeparateValuesFromString(&$section, 'л) заякоренные устройства', $arResult['TECH']['ancoreddev'], $blankSpace5, $blankSpace10, $fontCommon, $parLeft);

printSeparateValuesFromString(&$section, 'м) буксируемые устройства', $arResult['TECH']['coupleddev'], $blankSpace5, $blankSpace10, $fontCommon, $parLeft);

printSeparateValuesFromString(&$section, 'н) обитаемые и необитаемые аппараты', $arResult['TECH']['submarine'], $blankSpace5, $blankSpace10, $fontCommon, $parLeft);

printSeparateValuesFromString(&$section, 'о) летательные аппараты', $arResult['TECH']['planes'], $blankSpace5, $blankSpace10, $fontCommon, $parLeft);

printSeparateValuesFromString(&$section, 'п) другое оборудование', $arResult['TECH']['otherdev'], $blankSpace5, $blankSpace10, $fontCommon, $parLeft);

$section->writeText('', $fontCommon, $parLeft);

$section->writeText("12. Независимые автоматические научно-исследовательские устрановки и оборудование: ", $fontTitle, $parLeft);

$section->writeText('', $fontCommon, $parLeft);


if( count($arResult['EQUIP']) > 0 ){
			foreach ($arResult['EQUIP'] as $key=>$arItem){
				printSeparateValuesFromString(&$section, 'а) основные характеристики', $arItem['basic'], $blankSpace5, $blankSpace10, $fontCommon, $parLeft);
				printSeparateValuesFromString(&$section, 'б) характер получаемой информации и способ ее передачи', $arItem['infotype'], $blankSpace5, $blankSpace10, $fontCommon, $parLeft);
				$section->writeText($blankSpace5.'в-г) географические координаты (в градусах, минутах и долях минут) района использования (места постановки), даты (YYYY-MM-DD) постановки и демотажа, время действия:', $fontCommon, $parLeft);
$section->writeText('', $fontCommon, $parLeft);

				$table = $section->addTable();
				$table->addColumnsList(array(1,2.5,2.5,2.5,2.5,2.5,2.5 ));
				$table->addRow();

				writeToCell($table, 1, 1, ALIGN_CENTER, $fontTopSubHead, '№ точки', $border1pxBlack);
				writeToCell($table, 1, 2, ALIGN_CENTER, $fontTopSubHead, 'Дата прохождения', $border1pxBlack);
				writeToCell($table, 1, 3, ALIGN_CENTER, $fontTopSubHead, 'Географическая широта (в градусах, минутах и долях минут)', $border1pxBlack);
				writeToCell($table, 1, 4, ALIGN_CENTER, $fontTopSubHead, 'Географическая долгота (в градусах, минутах и долях минут)', $border1pxBlack);
				writeToCell($table, 1, 5, ALIGN_CENTER, $fontTopSubHead, 'Дата постановки', $border1pxBlack);
				writeToCell($table, 1, 6, ALIGN_CENTER, $fontTopSubHead, 'Дата демонтажа', $border1pxBlack);
				writeToCell($table, 1, 7, ALIGN_CENTER, $fontTopSubHead, 'Время действия', $border1pxBlack);

				$table->setBackgroundForCellRange('#cdcdcd', 1, 1, 1, 7);

				if( count($arResult['COORDS']['equip']) > 0 ){
					$counter = 2;
					foreach ($arResult['COORDS']['equip'] as $keyCoord=>$arCoord){
						if($arCoord['block'] == $arItem['block']){
							list($latGrad, $latMin) = explode(';', $arCoord['latitiude']);
							list($langGrad, $langMin, $langType) = explode(';', $arCoord['langitude']);
							$table->addRow();
							writeToCell($table, $counter, 1, ALIGN_CENTER, $fontCommon, $counter-1, $border1pxBlack);
							writeToCell($table, $counter, 2, ALIGN_LEFT, $fontCommon, $arCoord['landing_date'], $border1pxBlack, $arPadding);
							writeToCell($table, $counter, 3, ALIGN_LEFT, $fontCommon, $latGrad.'°'.$latMin.'\' с.ш.', $border1pxBlack, $arPadding);
							writeToCell($table, $counter, 4, ALIGN_LEFT, $fontCommon, $langGrad.'°'.$langMin.'\' '.($langType == 'з.д.' ? 'з.д.' : 'в.д.'), $border1pxBlack, $arPadding);
							writeToCell($table, $counter, 5, ALIGN_LEFT, $fontCommon, $arCoord['equip_install'], $border1pxBlack, $arPadding);
							writeToCell($table, $counter, 6, ALIGN_LEFT, $fontCommon, $arCoord['equip_deinstall'], $border1pxBlack, $arPadding);
							writeToCell($table, $counter, 7, ALIGN_LEFT, $fontCommon, $arCoord['time_usage'], $border1pxBlack, $arPadding);

							$counter++;
						}
					}
				}

				$section->writeText('', $fontCommon, $parLeft);

				$section->writeText($blankSpace5.'д) официальное наименование и юридический адрес владельца', $fontCommon, $parLeft);
				$section->writeText($blankSpace10.'Наименование организации: '.textUnderLine($arItem['equipowner']), $fontCommon, $parLeft);
				$country = getCountryNameById($arItem['equipowner_country'], $arResult['REFBOOK']['countries']);
				$section->writeText($blankSpace10.'Страна: '.$country, $fontCommon, $parLeft);
				$section->writeText($blankSpace10.'Город: '.$arItem['equipowner_city'], $fontCommon, $parLeft);
				$section->writeText($blankSpace10.'Юр. адрес организации: '.$arItem['equipowner_legaladdress'], $fontCommon, $parLeft);
				$section->writeText($blankSpace10.'Телефон: '.$arItem['equipowner_phone'], $fontCommon, $parLeft);
				$section->writeText($blankSpace10.'Факс: '.$arItem['equipowner_fax'], $fontCommon, $parLeft);
				$section->writeText($blankSpace10.'E-mail: '.$arItem['equipowner_email'], $fontCommon, $parLeft);
			}
}

$section->writeText('', $fontCommon, $parLeft);

$section->writeText("13. Возможное воздействие на окружающую среду, обеспечение отвественности за ущерб окружающей среде (наличие страховки): ", $fontTitle, $parLeft);
$section->writeText($arResult['EXPEDITION']['exp_ecology'], $fontCommon);

$section->writeText('', $fontCommon, $parLeft);

$section->writeText("14. Предложения по форме участия Российской Федерации в морских научних исследованиях (заполняется в случае, если заявитель не является государственной организацией Российской Федерации): ", $fontTitle, $parLeft);
$section->writeText($arResult['EXPEDITION']['exp_particip_rf'], $fontCommon);

$section->writeText('', $fontCommon, $parLeft);

$section->writeText("15. Использование результатов морских научных исследований, включая открытое опубликование и международный обмен (материалы исследований, планируемые для передачи иностранным государствам, их юридическим лицам и гражданам, международным организациям): ", $fontTitle, $parLeft);
$section->writeText($arResult['EXPEDITION']['exp_use_result'], $fontCommon, null);

$section->writeText('', $fontCommon, $parLeft);

$section->writeText("16. Срок представления отчета: ", $fontTitle, $parLeft);
if(!empty($arResult['EXPEDITION']['date_end']) && $arResult['EXPEDITION']['date_end'] != '0000-00-00'){
	list($year, $month, $date) = split('-',$arResult['EXPEDITION']['date_end']);
	$report_date =  date( 'j F Yг.', mktime(0, 0, 0, $month, $date+DEADLINE_PREV_REPORT, $year) ) ;
	$arMonthsEn = array('January', 'Fabruary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	$arMonthsRu = array('Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря');
	$report_date = str_replace( $arMonthsEn, $arMonthsRu, $report_date);
}else {
	$report_date = "дата не определена";
}
$section->writeText($report_date, $fontCommon);

$section->writeText('', $fontCommon, $parLeft);

$section->writeText('В случае получения разрешения Российской Федерации на проведение морских научных исследований, в отношении которых сделан данный запрос, заявитель обязуется:', $fontTitle, $parLeft);
$section->writeText($blankSpace5.'- соблюдать законодательство Российской Федерации, а также условия, указанные в разрешении;', $fontCommon, $parLeft);
$section->writeText($blankSpace5.'- обеспечивать соответствие заявленных технических характеристик средств наблюдения и контроля их действительным возможностям, а также соответствие получаемой в результате их размещения и использования информации обязательствам заявителя в области ее защиты и экспортного контроля.', $fontCommon, $parLeft);
$section->writeText('', $fontCommon, $parLeft);
$section->writeText('', $fontCommon, $parLeft);
$section->writeText('', $fontCommon, $parLeft);
$section->writeText('', $fontCommon, $parLeft);

$section->writeText('Дата                                                               Подпись заявителя', $fontCommon, $parLeft);
$section->writeText('', $fontCommon, $parLeft);
$section->writeText('', $fontCommon, $parLeft);
$section->writeText('Печать*', $fontCommon, $parLeft);
$section->writeText('', $fontCommon, $parLeft);
$section->writeText('', $fontCommon, $parLeft);
$section->writeText('', $fontCommon, $parLeft);
$section->writeText('_______________', $fontCommon, $parLeft);
$section->writeText('* Для юридического лица - печать организации-заявителя.', $fontCommon, $parLeft);
$section->writeText('   Для физического лица - печать органа, уполномоченного заверить подпись заявителя', $fontCommon, $parLeft);


$genFileName = date('U').'.rtf';
// save rtf document
$PHP_RTF->sendRtf($dir . '/files/reports/' .$genFileName);
die();
?>