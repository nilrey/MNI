<p class="subtitle">13. <?=requiredTitle('Возможное воздействие на окружающую среду, обеспечение отвественности за ущерб окружающей среде (наличие страховки)', 'exp_ecology')?></p>
<div class="shiftLeft20">
	<textarea name="EXPEDITION[ecology]" id="exp_ecology"><?=$arResult['EXPEDITION']['exp_ecology']?></textarea>
</div>
<p class="subtitle">14. <?=requiredTitle('Предложения по форме участия Российской Федерации в морских научних исследованиях (заполняется в случае, если заявитель не является государственной организацией Российской Федерации)', 'exp_particip_rf')?></p>
<div class="shiftLeft20">
	<textarea name="EXPEDITION[particip_rf]" id="exp_particip_rf"><?=$arResult['EXPEDITION']['exp_particip_rf']?></textarea>
</div>
<p class="subtitle">15. <?=requiredTitle('Использование результатов морских научных исследований, включая открытое опубликование и международный обмен (материалы исследований, планируемые для передачи иностранным государствам, их юридическим лицам и гражданам, международным организациям)', 'exp_use_result')?></p>
<div class="shiftLeft20">
	<textarea name="EXPEDITION[use_result]" id="exp_use_result" readonly><?=$arResult['EXPEDITION']['exp_use_result']?></textarea>
</div>
<p class="subtitle">16. Срок представления предварительного отчета</p>
<?
$arMonthsEn = array('January', 'Fabruary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
$arMonthsRu = array('Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря');
$year = '';
$month = '';
$date = '';
$report_date =  '';
if( checkStringDate($arResult["EXPEDITION"]["exp_report_date"]) ){
	list($year, $month, $date) = split('-',$arResult['EXPEDITION']['exp_report_date']);
	$report_date =  date( 'j F Yг.', mktime(0, 0, 0, $month, $date, $year) ) ;
}elseif (!empty($arResult['EXPEDITION']['date_end']) && $arResult['EXPEDITION']['date_end'] != '0000-00-00'){
	list($year, $month, $date) = split('-',$arResult['EXPEDITION']['date_end']);
	$report_date =  date( 'j F Yг.', mktime(0, 0, 0, $month, $date+DEADLINE_PREV_REPORT, $year) ) ;
}
if(!empty($report_date) ){
	$report_date = str_replace( $arMonthsEn, $arMonthsRu, $report_date);
}
if(empty($arResult['EXPEDITION']['id'])){
	$report_date = "дата не определена";
}?>
<div class="shiftLeft20">
	<input type="text" name="EXPEDITION[exp_report_date]" id="" style="border: 0px; width: 130px" value="<?=$report_date?>" readonly>
<?if( date("Y-m-d") > $report_date) {
?>
<input type="file" name="preReportFile" id="preReportFile" size="20">
<?
}?>
	* Предварительный отчет сдается не позже <?=DEADLINE_PREV_REPORT?> дней с момента окончания МНИ. <a href="#" onclick="gotoEndDate()">Дата окончания МНИ храниться в п. 8</a>
</div>
<?
if(!empty($arResult['PREREPORT']) && count($arResult['PREREPORT']) > 0){
	$i=0;
	?>
<div class="shiftLeft20">
	<table class="tab">
	<tr><td colspan="4" class="head">Файл предварительного отчета</td></tr>
	<tr>
	<td class="head">Дата</td>
	<td class="head">Имя файла</td>
	</tr>
	<?
	foreach ($arResult['PREREPORT'] as $file) {
			?>
			<tr class="trHighLighted">
				<td><?=$file['create_date']?></td>
				<td><a target="_blank" href="/files/prereports/<?=$file['name']?>"><?=$file['orig_name']?></a></td>
			</tr>
			<?
	}
	echo '</table></div>';
}?>
<br>
<br>
<p class="subtitle">17. Статус запроса:
<?
//var_dump($arResult['STATUS']);
if(empty($arResult["EXPEDITION"]["status"])) {
	$arResult["EXPEDITION"]["status"] = 0;
	$arResult["STATUS"] = array(0=>'Заполняется',10=>'Оформлен', 13=>'Отменен');
}
if(isset($arResult['EXPEDITION']['status']) && count($arResult['STATUS']) > 0){?>
	    <select name="EXPEDITION[statusExpedition]" id="statusExpedition">
	    <?foreach ($arResult['STATUS'] as $key=>$name){
    		$selected = '';
	    	if($key == $arResult['EXPEDITION']['status']){
	    		$selected = ' selected ';
	    	}
	    	?>
	    	<option value="<?=$key?>" <?=$selected?>><?=$name?>
    	<?}?>
	    </select>
<?}?>
</p>
<?
if(!empty($arResult['RECLAIMS']) && count($arResult['RECLAIMS']) > 0){
	$i=0;
	?>
	<table class="tab">
	<tr><td colspan="4" class="head">Файлы описания доработок</td></tr>
	<tr>
	<td class="head">№</td>
	<td class="head">Дата</td>
	<td class="head">Имя файла</td>
	<td class="head">Комментарий</td>
	</tr>
	<?
	foreach ($arResult['RECLAIMS'] as $file) {
			?>
			<tr class="trHighLighted">
				<td><?=++$i?></td>
				<td><?=$file['create_date']?></td>
				<td><a target="_blank" href="/files/reclaim/<?=$file['name']?>"><?=$file['name']?></a></td>
				<td><?=$file['comments']?></td>
			</tr>
			<?
	}
	echo '</table>';
}?>