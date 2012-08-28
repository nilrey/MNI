<?
function printSeparateValuesFromString(&$section, $strTitile, $strValue, $blankSpace1='', $blankSpace2=''){
	if(!empty($strValue)){
		$section->addText($blankSpace1.$strTitile.':');
		$arTmp = split( chr(13).chr(10), $strValue);
		foreach ($arTmp as $value) {
			$section->addText($blankSpace2.$value);
		}
	}else{
		$section->addText($blankSpace1."{$strTitile}: нет");
	}
}

// New Word Document
$PHPWord = new PHPWord();

/*********************************************************************************************************************************************

MEMO: If there is a trouble with print Encoding UTF-8 check of disturbance of functions "utf8_encode()" in files:
Textrun.php, Text.php, Section.php

**********************************************************************************************************************************************/

$section = $PHPWord->createSection();

$styleCommon= array('color'=>'000000', 'size'=>11, 'bold'=>false, 'align'=>'left');
$styleCmBold= array_merge($styleCommon, array('bold'=>true) );
$styleCmItalic= array_merge($styleCommon, array('italic'=>true) );
$styleCmUnLn= array_merge($styleCommon, array('underline'=>PHPWord_Style_Font::UNDERLINE_SINGLE) );

$styleSubHeader = array('color'=>'000000', 'size'=>10, 'bold'=>true, 'align'=>'center');
$styleHeader = array('color'=>'000000', 'size'=>14, 'bold'=>true, 'align'=>'center');
$PHPWord->addFontStyle('common', $styleCommon);
$PHPWord->addFontStyle('commonBold', $styleCmBold);
$PHPWord->addFontStyle('commonItal', $styleCmItalic);
$PHPWord->addFontStyle('commonUnLn', $styleCmUnLn);
$PHPWord->addFontStyle('styleSubHeader', $styleSubHeader);
$PHPWord->addFontStyle('styleHeader', $styleHeader);
$PHPWord->addParagraphStyle('pCenter', array('align'=>'center') );
$PHPWord->addParagraphStyle('pLeft', array('align'=>'left', 'marginLeft' => 100,) );
$blankSpace10 = '		';
$blankSpace5 = '	';

$styleTable = array('borderSize'=>1, 'borderColor'=>'000000', 'cellMargin'=>80);
$styleFirstRow = array('borderBottomSize'=>1, 'borderBottomColor'=>'000000', 'bgColor'=>'CDCDCD');
$styleCell = array('valign'=>'center');
//$styleCellBTLR = array('valign'=>'center', 'textDirection'=>PHPWord_Style_Cell::TEXT_DIR_BTLR);
$fontStyle = array('bold'=>true, 'align'=>'center');
$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);


$text = $section->addText('Запрос', 'styleHeader', 'pCenter');
$section->addText('на проведение морских научных исследований',null, 'pCenter');
$section->addTextBreak();

/*********************************************************************************************************************************************
                    APPLICANT
**********************************************************************************************************************************************/

$phone = '';
$country = '';
foreach ($arResult['REFBOOK']['countries'] as $item) {
	if($arResult['APPLICANT']['country'] == $item['id']) $country = $item['name'];
}

if(!empty($arResult['APPLICANT']['phone'])) $phone = 'Телефон:'.$arResult['APPLICANT']['phone'];
if(!empty($arResult['APPLICANT']['fax'])) $fax = 'Факс:'.$arResult['APPLICANT']['fax'];
if(!empty($arResult['APPLICANT']['telex'])) $telex = 'Телекс:'.$arResult['APPLICANT']['telex'];
if(!empty($arResult['APPLICANT']['email'])) $email = 'E-mail:'.$arResult['APPLICANT']['email'];

$textrun = $section->createTextRun('pLeft');
$textrun->addText("1. Заявитель: ", 'commonBold');
$textrun->addText($arResult['APPLICANT']['fullname'].';', 'commonUnLn');
$section->addText($blankSpace5.$country.',', 'common');
$section->addText($blankSpace5.$arResult['APPLICANT']['city'].', '.$arResult['APPLICANT']['legaladdress'], 'common');
$section->addText($blankSpace5.$phone, 'common');
$section->addText($blankSpace5.$fax, 'common');
$section->addText($blankSpace5.$telex, 'common');
$section->addText($blankSpace5.$email, 'common');

$section->addTextBreak();

/*********************************************************************************************************************************************
                    EXECUTOR
**********************************************************************************************************************************************/
$phone = '';
$country = '';
foreach ($arResult['REFBOOK']['countries'] as $item) {
	if($arResult['EXECUTOR']['country'] == $item['id']) $country = $item['name'];
}

if(!empty($arResult['EXECUTOR']['phone'])) $phone = 'Телефон:'.$arResult['EXECUTOR']['phone'];
if(!empty($arResult['EXECUTOR']['fax'])) $fax = 'Факс:'.$arResult['EXECUTOR']['fax'];
if(!empty($arResult['EXECUTOR']['telex'])) $telex = 'Телекс:'.$arResult['EXECUTOR']['telex'];
if(!empty($arResult['EXECUTOR']['email'])) $email = 'E-mail:'.$arResult['EXECUTOR']['email'];

$textrun = $section->createTextRun('pLeft');
$textrun->addText("2. Юридическое лицо (гражданин), уполномоченное на проведение морских научных исследований (заполняется в случае отличия от заявителя): ", 'commonBold');
$textrun->addText($arResult['EXECUTOR']['fullname'].';', 'commonUnLn');
$section->addText($blankSpace5.$country.',', 'common');
$section->addText($blankSpace5.$arResult['EXECUTOR']['city'].', '.$arResult['EXECUTOR']['legaladdress'], 'common');
$section->addText($blankSpace5.$phone, 'common');
$section->addText($blankSpace5.$fax, 'common');
$section->addText($blankSpace5.$telex, 'common');
$section->addText($blankSpace5.$email, 'common');

$section->addTextBreak();

/*********************************************************************************************************************************************
                    PARTICIPANT
**********************************************************************************************************************************************/

$textrun = $section->createTextRun('pLeft');
$textrun->addText("3. Участники морских научных исследований, не являющиеся заявителем либо юридическим лицом (гражданином), уполномоченным на проведение исследований: ", 'commonBold');
if( count($arResult['PARTICIPANT']) > 0 ){			
	foreach ($arResult['PARTICIPANT'] as $counter=>$arItem){
			$country = '';
			foreach ($arResult['REFBOOK']['countries'] as $arCountry){
				if($arCountry['id'] == $arItem['country']) $country = $arCountry['name'];
			}				
			switch ($arItem['type']) {
				case 1:
					$textrun = $section->createTextRun('pLeft');
					$textrun->addText("Официальное название: ", 'common');						
					$textrun->addText($arItem['fullname'].';', 'commonUnLn');
					$section->addText($blankSpace5.$country.',', 'common');
					$section->addText($blankSpace5.$arItem['city'].', '.$arItem['legaladdress'], 'common');
					$section->addText($blankSpace5.'Телефон:'.$arItem['phone'], 'common');
					$section->addText($blankSpace5.'Факс:'.$arItem['fax'], 'common');
					$section->addText($blankSpace5.'Телекс:'.$arItem['telex'], 'common');
					$section->addText($blankSpace5.'E-mail:'.$arItem['email'], 'common');

		break;
				case 2:
					$textrun = $section->createTextRun('pLeft');
					$textrun->addText("Фамилия Имя Отчество: ", 'common', 'pLeft');						
					$textrun->addText($arItem['fio'].';', 'commonUnLn');
					$section->addText($blankSpace5."Гражданство: ".$country.',', 'common');
					$section->addText($blankSpace5."Место работы: ".$arItem['workaddress'], 'common');
					$section->addText($blankSpace5."Форма участия: ".$arItem['particip'], 'common');

		break;
		}
	}
}
$section->addTextBreak();

/*********************************************************************************************************************************************
                    MAINTRANSPORT
**********************************************************************************************************************************************/

$section->addText("4. Описание судна (другого транспортного средства), которое используется в морских научных исследованиях: ", 'commonBold');

if(!empty($arResult['MAINTRANSPORT'])){
	$trnsp = '';
	if($arResult['MAINTRANSPORT']['type'] == 'ship'){ 
		$trnsp = ' Судно ';
	}
	elseif ($arResult['MAINTRANSPORT']['type'] == 'other'){
	 $trnsp = ' Другое ТС ';
	}
	if(!empty($trnsp)){
		$section->addText($blankSpace5."Тип транспортного средства: ".$trnsp, 'common');
		switch ($arResult['MAINTRANSPORT']['type']){
			case 'ship':
				
				$countriesList = '';
				foreach ($arResult['REFBOOK']['countries'] as $country){
					$selected = '';
					if($country['id'] == $arResult['MAINTRANSPORT']['nation']) $countriesList = $country['name'];
					
				}
				
				$section->addText($blankSpace5.'Название: '.$arResult['MAINTRANSPORT']['name'], 'common');	
				$section->addText($blankSpace5.'Национальность: '.$countriesList, 'common');	
				$section->addText($blankSpace5.'Судовладелец: '.$arResult['MAINTRANSPORT']['shipowner'], 'common');
				
				$countriesList = '';
				foreach ($arResult['REFBOOK']['countries'] as $country){
					if($country['id'] == $arResult['MAINTRANSPORT']['shipowner_country']) $countriesList = $country['name'];
				}
				$section->addText($blankSpace10.'Государство: '.$countriesList, 'common' );
				$section->addText($blankSpace10.'Город: '.$arResult['MAINTRANSPORT']['shipowner_city'], 'common');	
				$section->addText($blankSpace10.'Юридический адрес: '.$arResult['MAINTRANSPORT']['shipowner_legaladdress'], 'common');	
				$section->addText($blankSpace10.'Телефон: '.$arResult['MAINTRANSPORT']['shipowner_phone'], 'common' );	
				$section->addText($blankSpace10.'Телефакс: '.$arResult['MAINTRANSPORT']['shipowner_fax'], 'common' );	
				$section->addText($blankSpace10.'Телекс: '.$arResult['MAINTRANSPORT']['shipowner_telex'], 'common' );	
				$section->addText($blankSpace10.'E-mail: '.$arResult['MAINTRANSPORT']['shipowner_email'], 'common' );	
				
				$section->addText($blankSpace5.'Порт приписки: '.$arResult['MAINTRANSPORT']['homeport'], 'common' );	
				$section->addText($blankSpace5.'Назначение: '.$arResult['MAINTRANSPORT']['func'], 'common');	
				$section->addText($blankSpace5.'Наибольшая длина: '.$arResult['MAINTRANSPORT']['length'], 'common');	
				$section->addText($blankSpace5.'Наибольшая ширина: '.$arResult['MAINTRANSPORT']['width'], 'common');	
				$section->addText($blankSpace5.'Наибольшая осадка: '.$arResult['MAINTRANSPORT']['draught'], 'common' );	
				$section->addText($blankSpace5.'Мореходность: '.$arResult['MAINTRANSPORT']['seaworth'], 'common');	
				$section->addText($blankSpace5.'Полное водоизмещение: '.$arResult['MAINTRANSPORT']['displace'], 'common' );	
				$section->addText($blankSpace5.'Тип и мощность главной энергетической установки: '.$arResult['MAINTRANSPORT']['generator'], 'common');	
				$section->addText($blankSpace5.'Радиочастоты: '.$arResult['MAINTRANSPORT']['rdfreq'], 'common');	
				$section->addText($blankSpace5.'Радиопозывные: '.$arResult['MAINTRANSPORT']['rdsign'], 'common' );	
				$section->addText($blankSpace5.'Экипаж:', 'commonItal');	
				$section->addText($blankSpace5.'Капитан: '.$arResult['MAINTRANSPORT']['capt'], 'common');	
				$section->addText($blankSpace5.'Команда: '.$arResult['MAINTRANSPORT']['crew'], 'common');	
				$section->addText($blankSpace5.'Экспедиционный состав: '.$arResult['MAINTRANSPORT']['researchers'], 'common');	
				$section->addText($blankSpace5.'Руководитель морских научных исследований: '.$arResult['MAINTRANSPORT']['head'], 'common');	
				break;
				
			case 'other':
				$section->addText($blankSpace5.'Название: '.$arResult['MAINTRANSPORT']['name'], 'common');
				$section->addText($blankSpace5.'Экипаж:', 'commonItal');	
				$section->addText($blankSpace5.'Капитан: '.$arResult['MAINTRANSPORT']['capt'], 'common');
				$section->addText($blankSpace5.'Команда: '.$arResult['MAINTRANSPORT']['crew'], 'common' );
				$section->addText($blankSpace5.'Экспедиционный состав: '.$arResult['MAINTRANSPORT']['researchers'], 'common');
				$section->addText($blankSpace5.'Руководитель морских научных исследований: '.$arResult['MAINTRANSPORT']['head'], 'common');
						
				break;	
		}
	}
}
$section->addTextBreak();


/*********************************************************************************************************************************************
                    TRANSPORT
**********************************************************************************************************************************************/

$section->addText("5. Описание судов (других транспортных средств), которые используются в морских научных исследованиях, наряду с судном (другим транспортным средством), указаным в пункте 4 (заполняется для каждого судна или транспортного средства отдельно): ", 'commonBold');
if(!empty($arResult['TRANSPORT'])){
	foreach ($arResult['TRANSPORT'] as $key => $arItem) {
		$trnsp = '';
		if($arResult['MAINTRANSPORT']['type'] == 'ship'){ 
			$trnsp = ' Судно ';
		}
		elseif ($arResult['MAINTRANSPORT']['type'] == 'other'){
		 $trnsp = ' Другое ТС ';
		}
		if(!empty($trnsp)){
			$section->addText($blankSpace5."Тип транспортного средства: ".$trnsp, 'common');
			switch ($arItem['type']){
				case 'ship':
					$countriesList = '';
					foreach ($arResult['REFBOOK']['countries'] as $country){
						if($country['id'] == $arItem['nation']) $countriesList = $country['name'];
					}
					$section->addText($blankSpace5.'Название: '.$arItem['name'], 'common');	
					$section->addText($blankSpace5.'Национальность: '.$countriesList, 'common');	
					$section->addText($blankSpace5.'Судовладелец: '.$arItem['shipowner'], 'common' );
					
					$countriesList = '';
					foreach ($arResult['REFBOOK']['countries'] as $country){
						if($country['id'] == $arItem['shipowner_country']) $countriesList = $country['name'];
					}
					$section->addText($blankSpace10.'Государство: '.$countriesList, 'common');
					$section->addText($blankSpace10.'Город: '.$arItem['shipowner_city'], 'common');	
					$section->addText($blankSpace10.'Юридический адрес: '.$arItem['shipowner_legaladdress'], 'common' );	
					$section->addText($blankSpace10.'Телефон: '.$arItem['shipowner_phone'], 'common' );	
					$section->addText($blankSpace10.'Телефакс: '.$arItem['shipowner_fax'], 'common' );	
					$section->addText($blankSpace10.'Телекс: '.$arItem['shipowner_telex'], 'common' );	
					$section->addText($blankSpace10.'E-mail: '.$arItem['shipowner_email'], 'common' );	
					
					$section->addText($blankSpace5.'Порт приписки: '.$arItem['homeport'], 'common' );	
					$section->addText($blankSpace5.'Назначение: '.$arItem['func'], 'common');	
					$section->addText($blankSpace5.'Наибольшая длина: '.$arItem['length'], 'common' );	
					$section->addText($blankSpace5.'Наибольшая ширина: '.$arItem['width'], 'common');	
					$section->addText($blankSpace5.'Наибольшая осадка: '.$arItem['draught'], 'common');	
					$section->addText($blankSpace5.'Мореходность: '.$arItem['seaworth'], 'common');	
					$section->addText($blankSpace5.'Полное водоизмещение: '.$arItem['displace'], 'common' );	
					$section->addText($blankSpace5.'Тип и мощность главной энергетической установки: '.$arItem['generator'], 'common' );	
					$section->addText($blankSpace5.'Радиочастоты: '.$arItem['rdfreq'], 'common');	
					$section->addText($blankSpace5.'Радиопозывные: '.$arItem['rdsign'], 'common' );	
					$section->addText($blankSpace5.'Экипаж:', 'commonItal');	
					$section->addText($blankSpace5.'Капитан: '.$arItem['capt'], 'common');	
					$section->addText($blankSpace5.'Команда: '.$arItem['crew'], 'common');	
					$section->addText($blankSpace5.'Экспедиционный состав: '.$arItem['researchers'], 'common');	
					$section->addText($blankSpace5.'Руководитель морских научных исследований: '.$arItem['head'], 'common');	
							
				break;
				case 'other':
					$section->addText($blankSpace5.'Название: '.$arItem['name'], 'common');
					$section->addText($blankSpace5.'Экипаж:', 'commonItal');	
					$section->addText($blankSpace5.'Капитан: '.$arItem['capt'], 'common');
					$section->addText($blankSpace5.'Команда: '.$arItem['crew'], 'common');
					$section->addText($blankSpace5.'Экспедиционный состав: '.$arItem['researchers'], 'common');
					$section->addText($blankSpace5.'Руководитель морских научных исследований: '.$arItem['head'], 'common');
				break;

			}
		}
	}
}else{
	$section->addText($blankSpace5.'Другие транспортные средства не используются.', 'common');
}
$section->addTextBreak();

/*********************************************************************************************************************************************
                    ROOT
**********************************************************************************************************************************************/

$section->addText("6. Маршрут движения судна от точки пересечения границы Российской Федерации до района морских научных исследований и обратно (для иностранных судов): ", 'commonBold');

$table = $section->addTable('myOwnTableStyle');
$table->addRow();
$table->addCell(500, $styleCell)->addText("№ точки", $fontStyle, 'pCenter');
$table->addCell(2800, $styleCel)->addText("Дата прохождения", $fontStyle, 'pCenter');
$table->addCell(2800, $styleCell)->addText("Географическая широта (в градусах, минутах и долях минут)", $fontStyle, 'pCenter');
$table->addCell(2800, $styleCell)->addText("Географическая долгота (в градусах, минутах и долях минут)", $fontStyle, 'pCenter');

if( count($arResult['COORDS']['shiproot']) > 0 ){			
	foreach ($arResult['COORDS']['shiproot'] as $key=>$arItem){
		$counter = $key + 1;
		list($latGrad, $latMin) = explode(';', $arItem['latitiude']);
		list($langGrad, $langMin, $langType) = explode(';', $arItem['langitude']);
		$table->addRow();
		$table->addCell(500)->addText($counter);
		$table->addCell(2800)->addText($arItem['landing_date']);
		$table->addCell(2800)->addText($latGrad.'°'.$latMin.'\' с.ш.');
		$table->addCell(2800)->addText($langGrad.'°'.$langMin.'\' '.($langType == 'з.д.' ? 'з.д.' : 'в.д.'));
	}
}
$section->addTextBreak();

$section->addText("7. Названия потров Российской Федерации, дата, (YYYY-MM-DD) и цель их посещения (для иностранных судов): ", 'commonBold');

$table = $section->addTable('myOwnTableStyle');
$table->addRow();
$table->addCell(500, $styleCell)->addText("№ точки", $fontStyle, 'pCenter');
$table->addCell(2800, $styleCel)->addText("Дата прохождения", $fontStyle, 'pCenter');
$table->addCell(2800, $styleCell)->addText("Название", $fontStyle, 'pCenter');
$table->addCell(2800, $styleCell)->addText("Цель посещения (для иностранных судов)", $fontStyle, 'pCenter');

if( count($arResult['PORTS']['ports']) > 0 ){			
	foreach ($arResult['PORTS']['ports'] as $key=>$arItem){
		$counter = $key + 1;
		$table->addRow();
		$table->addCell(500)->addText($counter);
		$table->addCell(2800)->addText($arItem['landing_date']);
		$table->addCell(2800)->addText($arItem['port']);
		$table->addCell(2800)->addText($arItem['comment']);
	}
}
$section->addTextBreak();

$section->addText("8. Дата первого прибытия в район морских научных исследований:   ".$arResult['EXPEDITION']['date_start'], 'commonBold');

$section->addTextBreak();

$section->addText("   Дата окончательного ухода  из района морских научных исследований: ".$arResult['EXPEDITION']['date_end'], 'commonBold');

$section->addTextBreak();

$section->addText("9. Координаты района морских научных исследований: ", 'commonBold');

$section->addTextBreak();

$table = $section->addTable('myOwnTableStyle');
$table->addRow();
$table->addCell(500, $styleCell)->addText("№ точки", $fontStyle, 'pCenter');
$table->addCell(2800, $styleCel)->addText("Дата прохождения", $fontStyle, 'pCenter');
$table->addCell(2800, $styleCell)->addText("Географическая широта (в градусах, минутах и долях минут)", $fontStyle, 'pCenter');
$table->addCell(2800, $styleCell)->addText("Географическая долгота (в градусах, минутах и долях минут)", $fontStyle, 'pCenter');

if( count($arResult['COORDS']['mniregion']) > 0 ){			
	foreach ($arResult['COORDS']['mniregion'] as $key=>$arItem){
		$counter = $key + 1;
		list($latGrad, $latMin) = explode(';', $arItem['latitiude']);
		list($langGrad, $langMin, $langType) = explode(';', $arItem['langitude']);
		$table->addRow();
		$table->addCell(500)->addText($counter);
		$table->addCell(2800)->addText($arItem['landing_date']);
		$table->addCell(2800)->addText($latGrad.'°'.$latMin.'\' с.ш.');
		$table->addCell(2800)->addText($langGrad.'°'.$langMin.'\' '.($langType == 'з.д.' ? 'з.д.' : 'в.д.'));
	}
}
$section->addTextBreak();

$section->addText("   Маршрут движения судна в районе морских научных исследований (если исследования осуществляются по маршруту): ", 'common');

$section->addTextBreak();

$table = $section->addTable('myOwnTableStyle');
$table->addRow();
$table->addCell(500, $styleCell)->addText("№ точки", $fontStyle, 'pCenter');
$table->addCell(2800, $styleCel)->addText("Дата прохождения", $fontStyle, 'pCenter');
$table->addCell(2800, $styleCell)->addText("Географическая широта (в градусах, минутах и долях минут)", $fontStyle, 'pCenter');
$table->addCell(2800, $styleCell)->addText("Географическая долгота (в градусах, минутах и долях минут)", $fontStyle, 'pCenter');

if( count($arResult['COORDS']['mniroot']) > 0 ){			
	foreach ($arResult['COORDS']['mniroot'] as $key=>$arItem){
		$counter = $key + 1;
		list($latGrad, $latMin) = explode(';', $arItem['latitiude']);
		list($langGrad, $langMin, $langType) = explode(';', $arItem['langitude']);
		$table->addRow();
		$table->addCell(500)->addText($counter);
		$table->addCell(2800)->addText($arItem['landing_date']);
		$table->addCell(2800)->addText($latGrad.'°'.$latMin.'\' с.ш.');
		$table->addCell(2800)->addText($langGrad.'°'.$langMin.'\' '.($langType == 'з.д.' ? 'з.д.' : 'в.д.'));
	}
}
$section->addTextBreak();

$section->addText("10. Программа морских научных исследований: ", 'commonBold');
$section->addText($blankSpace5."а) Название: ".$arResult['EXPEDITION']['mni_name'], 'common');
$section->addText($blankSpace5."б) Цель: ".$arResult['EXPEDITION']['mni_aim'], 'common');
$section->addText($blankSpace5."в) Виды морских научных исследований (работ), методы и последовательность их выполнения: ", 'common');
$section->addTextBreak();
$table = $section->addTable('myOwnTableStyle');
$table->addRow();
$table->addCell(500, $styleCell)->addText("№ точки", $fontStyle, 'pCenter');
$table->addCell(2100, $styleCel)->addText("Тип наблюдений", $fontStyle, 'pCenter');
$table->addCell(2100, $styleCel)->addText("Вид наблюдений", $fontStyle, 'pCenter');
$table->addCell(2100, $styleCel)->addText("Структурная единица", $fontStyle, 'pCenter');
$table->addCell(2100, $styleCel)->addText("Количество", $fontStyle, 'pCenter');

if( count($arResult['MNITYPE']['meteo']) > 0 ){			
	foreach ($arResult['MNITYPE']['meteo'] as $key=>$arItem){
		$counter = $key + 1;
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
		$counter = $key + 1;
		list($latGrad, $latMin) = explode(';', $arItem['latitiude']);
		list($langGrad, $langMin, $langType) = explode(';', $arItem['langitude']);
		$table->addRow();
		$table->addCell(500)->addText($counter);
		$table->addCell(2100)->addText($mnitype);
		$table->addCell(2100)->addText($mnisort);
		$table->addCell(2100)->addText($mniunit);
		$table->addCell(2100)->addText($arItem['amount']);
	}
}
$section->addTextBreak();

$section->addText($blankSpace5."г) Формы использования берегововй информаструктуры Российской Федерации, географические координаты (в градусах, минутах и долях минут) мест предполагаемых высадок на побережье Российской Федерации: ", 'common');
$section->addTextBreak();

$table = $section->addTable('myOwnTableStyle');
$table->addRow();
$table->addCell(500, $styleCell)->addText("№ точки", $fontStyle, 'pCenter');
$table->addCell(2800, $styleCel)->addText("Дата прохождения", $fontStyle, 'pCenter');
$table->addCell(2800, $styleCell)->addText("Географическая широта (в градусах, минутах и долях минут)", $fontStyle, 'pCenter');
$table->addCell(2800, $styleCell)->addText("Географическая долгота (в градусах, минутах и долях минут)", $fontStyle, 'pCenter');

if( count($arResult['COORDS']['mnishore']) > 0 ){			
	foreach ($arResult['COORDS']['mnishore'] as $key=>$arItem){
		$counter = $key + 1;
		list($latGrad, $latMin) = explode(';', $arItem['latitiude']);
		list($langGrad, $langMin, $langType) = explode(';', $arItem['langitude']);
		$table->addRow();
		$table->addCell(500)->addText($counter);
		$table->addCell(2800)->addText($arItem['landing_date']);
		$table->addCell(2800)->addText($latGrad.'°'.$latMin.'\' с.ш.');
		$table->addCell(2800)->addText($langGrad.'°'.$langMin.'\' '.($langType == 'з.д.' ? 'з.д.' : 'в.д.'));
	}
}
$section->addTextBreak();

$section->addText($blankSpace5."д) географические координаты (в градусах, минутах и долях минут) мест предполагаемых высадок на лед: ", 'common');

$section->addTextBreak();

$table = $section->addTable('myOwnTableStyle');
$table->addRow();
$table->addCell(500, $styleCell)->addText("№ точки", $fontStyle, 'pCenter');
$table->addCell(2800, $styleCel)->addText("Дата прохождения", $fontStyle, 'pCenter');
$table->addCell(2800, $styleCell)->addText("Географическая широта (в градусах, минутах и долях минут)", $fontStyle, 'pCenter');
$table->addCell(2800, $styleCell)->addText("Географическая долгота (в градусах, минутах и долях минут)", $fontStyle, 'pCenter');

if( count($arResult['COORDS']['mniice']) > 0 ){			
	foreach ($arResult['COORDS']['mniice'] as $key=>$arItem){
		$counter = $key + 1;
		list($latGrad, $latMin) = explode(';', $arItem['latitiude']);
		list($langGrad, $langMin, $langType) = explode(';', $arItem['langitude']);
		$table->addRow();
		$table->addCell(500)->addText($counter);
		$table->addCell(2800)->addText($arItem['landing_date']);
		$table->addCell(2800)->addText($latGrad.'°'.$latMin.'\' с.ш.');
		$table->addCell(2800)->addText($langGrad.'°'.$langMin.'\' '.($langType == 'з.д.' ? 'з.д.' : 'в.д.'));
	}
}
$section->addTextBreak();

$section->addText($blankSpace5."е) потребность в специализвированном гидрометеорологическом обеспечении (предоставляется учреждениями федерального органа испольнительной власти в области гидрометорологниии и мониторгинга окружающей среды по договору с заявителем): ", 'common');
$section->addText($blankSpace5.$arResult['EXPEDITION']['mni_spec'], 'common');

$section->addTextBreak();

//$textrun = $section->createTextRun('pLeft');

$section->addText($blankSpace5."11. Технические средства морс ких научных исследований (основные характеристики, официальное наименование и юридический адрес владельца), за исключением предусмотренных пунктом 12: ", 'commonBold');

printSeparateValuesFromString(&$section, 'а) гидрографические', $arResult['TECH']['hydrograph'], $blankSpace5, $blankSpace10);

printSeparateValuesFromString(&$section, 'б) гидроакустические', $arResult['TECH']['hydroacustic'], $blankSpace5, $blankSpace10);

printSeparateValuesFromString(&$section, 'в) магнитометрические', $arResult['TECH']['magnitometr'], $blankSpace5, $blankSpace10);

printSeparateValuesFromString(&$section, 'г) сейсмические', $arResult['TECH']['seismic'], $blankSpace5, $blankSpace10);

printSeparateValuesFromString(&$section, 'д) метеорологические', $arResult['TECH']['meteorolog'], $blankSpace5, $blankSpace10);

printSeparateValuesFromString(&$section, 'ж) океанографические', $arResult['TECH']['oceanograph'], $blankSpace5, $blankSpace10);

printSeparateValuesFromString(&$section, 'з) оборудование для биологических исследований', $arResult['TECH']['bioresearch'], $blankSpace5, $blankSpace10);

printSeparateValuesFromString(&$section, 'и) оборудование для взятия проб воды, грунта, донных отложений, биологических и других проб', $arResult['TECH']['probation'], $blankSpace5, $blankSpace10);

printSeparateValuesFromString(&$section, 'к) ныряющие устройства', $arResult['TECH']['divingdev'], $blankSpace5, $blankSpace10);

printSeparateValuesFromString(&$section, 'л) заякоренные устройства', $arResult['TECH']['ancoreddev'], $blankSpace5, $blankSpace10);

printSeparateValuesFromString(&$section, 'м) буксируемые устройства', $arResult['TECH']['coupleddev'], $blankSpace5, $blankSpace10);

printSeparateValuesFromString(&$section, 'н) обитаемые и необитаемые аппараты', $arResult['TECH']['submarine'], $blankSpace5, $blankSpace10);

printSeparateValuesFromString(&$section, 'о) летательные аппараты', $arResult['TECH']['planes'], $blankSpace5, $blankSpace10);

printSeparateValuesFromString(&$section, 'п) другое оборудование', $arResult['TECH']['otherdev'], $blankSpace5, $blankSpace10);

$section->addTextBreak();

$section->addText("12. Независимые автоматические научно-исследовательские устрановки и оборудование: ", 'commonBold');

$section->addTextBreak();


$table = $section->addTable('myOwnTableStyle');
$table->addRow();
$table->addCell(500, $styleCell)->addText("№ точки", $fontStyle, 'pCenter');
$table->addCell(2000, $styleCel)->addText("Основные характеристики", $fontStyle, 'pCenter');
$table->addCell(2000, $styleCell)->addText("Характер получаемой информации и способ ее передачи", $fontStyle, 'pCenter');
$table->addCell(2000, $styleCell)->addText("Географические координаты (в градусах, минутах и долях минут) района использования (места постановки)", $fontStyle, 'pCenter');
$table->addCell(2000, $styleCel)->addText("Даты (YYYY-MM-DD) постановки и демотажа, время действия", $fontStyle, 'pCenter');
$table->addCell(2000, $styleCel)->addText("Официальное наименование и юридический адрес владельца", $fontStyle, 'pCenter');

if( count($arResult['EQUIP']) > 0 ){			
	foreach ($arResult['EQUIP'] as $key=>$arItem){
		$counter = $key + 1;
		$table->addRow();
		$table->addCell(500)->addText($counter);
		$table->addCell(2000)->addText($arItem['basic']);
		$table->addCell(2000)->addText($arItem['infotype']);
		$table->addCell(2000)->addText($arItem['coord']);
		$table->addCell(2000)->addText($arItem['dates']);
		$table->addCell(2000)->addText($arItem['owner']);
	}
}
$section->addTextBreak();

$section->addText("13. Возможное воздействие на окружающую среду, обеспечение отвественности за ущерб окружающей среде (наличие страховки): ", 'commonBold');
$section->addText($arResult['EXPEDITION']['exp_ecology'], 'common');

$section->addTextBreak();

$section->addText("14. Предложения по форме участия Российской Федерации в морских научних исследованиях (заполняется в случае, если заявитель не является государственной организацией Российской Федерации): ", 'commonBold');
$section->addText($arResult['EXPEDITION']['exp_particip_rf'], 'common');

$section->addTextBreak();

$section->addText("15. Использование результатов морских научных исследований, включая открытое опубликование и международный обмен (материалы исследований, планируемые для передачи иностранным государствам, их юридическим лицам и гражданам, международным организациям): ", 'commonBold');
$section->addText($arResult['EXPEDITION']['exp_use_result'], 'common');

$section->addTextBreak();

$section->addText("16. Срок представления отчета: ", 'commonBold');
if(!empty($arResult['EXPEDITION']['date_end']) && $arResult['EXPEDITION']['date_end'] != '0000-00-00'){
	list($year, $month, $date) = split('-',$arResult['EXPEDITION']['date_end']);
	$report_date =  date( 'j F Yг.', mktime(0, 0, 0, $month, $date+DEADLINE_PREV_REPORT, $year) ) ;
	$arMonthsEn = array('January', 'Fabruary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	$arMonthsRu = array('Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря');
	$report_date = str_replace( $arMonthsEn, $arMonthsRu, $report_date);
}else {
	$report_date = "дата не определена";
}
$section->addText($report_date, 'common');

$section->addTextBreak(5);

$section->addText('В случае получения разрешения Российской Федерации на проведение морских научных исследований, в отношении которых сделан данный запрос, заявитель обязуется:', 'commonBold');
$section->addText('- соблюдать законодательство Российской Федерации, а также условия, указанные в разрешении;', 'common');
$section->addText('- обеспечивать соответствие заявленных технических характеристик средств наблюдения и контроля их действительным возможностям, а также соответствие получаемой в результате их размещения и использования информации обязательствам заявителя в области ее защиты и экспортного контроля.', 'common');
$section->addTextBreak(4);
$section->addText('Дата                                                               Подпись заявителя', 'common');
$section->addTextBreak(2);
$section->addText('Печать*', 'common');
$section->addTextBreak(3);
$section->addText('_______________', 'common');
$section->addText('* Для юридического лица - печать организации-заявителя.', 'common');
$section->addText('  Для физического лица - печать органа, уполномоченного заверить подпись заявителя', 'common');

// Save File
$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');

$baseName = md5($USER->getUserId().'-'.date('U') );
$fileNameZip =  $baseName.'.zip';
$fileName = $baseName.'.docx';

$filePath = $_SERVER['DOCUMENT_ROOT'].'/files/reports/'.$fileName;
$filePathZip = $_SERVER['DOCUMENT_ROOT'].'/files/reports/'.$fileNameZip;
$objWriter->save($filePath);

//var_dump("http://www.mni.citis.ru/files/reports/{$fileName}");
//header("Location: 'http://www.mni.citis.ru/files/reports/{$fileName}'");


$zip = new ZipArchive;

if ($zip->open($_SERVER['DOCUMENT_ROOT'].'/files/reports/'.$fileNameZip, ZIPARCHIVE::CREATE) === TRUE) {
    $zip->addFile($filePath, basename($filePath));
    $zip->close();
	if (file_exists($filePathZip)){
$arParams['REPORT_FILE']['NAME'] = $fileNameZip;
$arParams['REPORT_FILE']['PATH'] = '/files/reports/'.$fileNameZip;
//		
//header("Content-type: application/octet-stream");
//	    header('Content-Length: ' . filesize($filePathZip));
//header("Content-disposition: attachment; filename=archive.zip");
////	    header('Content-Description: File Transfer');
////	    header('Content-Type: application/zip');
////	    header('Content-Disposition: attachment; filename='.basename($filePathZip));
////	    header('Content-Transfer-Encoding: binary');
////	    header('Expires: 0');
////	    header('Cache-Control: must-revalidate');
////	    header('Pragma: public');
////	    ob_clean();
////	    flush();
//	    echo readfile($filePathZip);
////	    unlink($filePathZip);
////	    unlink($filePath);
//	    die();
	}
}
//$objWriter->save('php://stdout');
//var_dump($arParams); 
?> 