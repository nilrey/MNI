<p class="subtitle">13. Возможное воздействие на окружающую среду, обеспечение отвественности за ущерб окружающей среде (наличие страховки)</p>
<div class="shiftLeft20">
	<?=$arResult['EXPEDITION']['exp_ecology']?>
</div>
<p class="subtitle">14. Предложения по форме участия Российской Федерации в морских научних исследованиях (заполняется в случае, если заявитель не является государственной организацией Российской Федерации)</p>
<div class="shiftLeft20">
	<?=$arResult['EXPEDITION']['exp_particip_rf']?>
</div>
<p class="subtitle">15. Использование результатов морских научных исследований, включая открытое опубликование и международный обмен (материалы исследований, планируемые для передачи иностранным государствам, их юридическим лицам и гражданам, международным организациям)</p>
<div class="shiftLeft20">
	<?=$arResult['EXPEDITION']['exp_use_result']?>
</div>
<p class="subtitle">16. Срок представления отчетов:</p>
<?
if(!empty($arResult['EXPEDITION']['date_end']) && $arResult['EXPEDITION']['date_end'] != '0000-00-00'){
	list($year, $month, $date) = split('-',$arResult['EXPEDITION']['date_end']);
	$pre_report_date =  date( 'j F Yг.', mktime(0, 0, 0, $month, $date+DEADLINE_PREV_REPORT, $year) ) ;
	$final_report_date =  date( 'j F Yг.', mktime(0, 0, 0, $month, $date+DEADLINE_MAIN_REPORT, $year) ) ;
	$arMonthsEn = array('January', 'Fabruary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	$arMonthsRu = array('Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря');
	$pre_report_date = str_replace( $arMonthsEn, $arMonthsRu, $pre_report_date);
	$final_report_date = str_replace( $arMonthsEn, $arMonthsRu, $final_report_date);
}else {
	$pre_report_date = "дата не определена";
	$final_report_date = "дата не определена";
}?>
<div class="shiftLeft20">
	<input type="text" name="EXPEDITION[exp_report_date]" id="" style="border: 0px; width: 130px" value="<?=$pre_report_date?>" readonly> (Не сдан) * Предварительный отчет сдается не позже <?=DEADLINE_PREV_REPORT?> дней с момента окончания МНИ. Дата окончания МНИ храниться в п. 8
	<br>
	<input type="text" name="EXPEDITION[report_date]" id="" style="border: 0px; width: 130px" value="<?=$final_report_date?>" readonly>  (<?=(empty($arResult['EXPEDITION']['final_report']) ? ' Не сдан ': ' Сдан ' )?>) * Окончательный отчет сдается не позже 90 дней с момента окончания МНИ. Дата окончания МНИ храниться в п. 8
</div>
<br>
<p class="subtitle">17. Статус запроса:  
<?
//var_dump($arResult['STATUS']);
if(!empty($arResult['EXPEDITION']['status']) && count($arResult['STATUS']) > 0){?>
	    <?foreach ($arResult['STATUS'] as $key=>$name){
	    	if($key == $arResult['EXPEDITION']['status']){
	    		echo $name;
	    	}
	    }
}?>
</p>
<p class="subtitle">18. Статус отчета: 
<select name="EXPEDITION[final_report]" id="">
	<option value="0" <?=(empty($arResult['EXPEDITION']['final_report']) ? ' selected ': '')?>>не сдан
	<option value="1" <?=(!empty($arResult['EXPEDITION']['final_report']) ? ' selected ': '')?>>сдан
</select>