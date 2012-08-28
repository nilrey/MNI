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
<p class="subtitle">16. Срок представления отчета</p>
<?
if(!empty($arResult['EXPEDITION']['date_end']) && $arResult['EXPEDITION']['date_end'] != '0000-00-00'){
	list($year, $month, $date) = split('-',$arResult['EXPEDITION']['date_end']);
	$report_date =  date( 'j F Yг.', mktime(0, 0, 0, $month, $date+DEADLINE_PREV_REPORT, $year) ) ;
	$arMonthsEn = array('January', 'Fabruary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	$arMonthsRu = array('Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря');
	$report_date = str_replace( $arMonthsEn, $arMonthsRu, $report_date);
}else {
	$report_date = "дата не определена";
}?>
<div class="shiftLeft20">
	<input type="text" name="EXPEDITION[exp_report_date]" id="" style="border: 0px; width: 130px" value="<?=$report_date?>" readonly> * Предварительный отчет сдается не позже <?=DEADLINE_PREV_REPORT?> дней с момента окончания МНИ. Дата окончания МНИ храниться в п. 8
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
			<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
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
if(!empty($arResult['EXPEDITION']['status']) && count($arResult['STATUS']) > 0){?>
	    <select name="EXPEDITION[statusExpedition]" id="statusExpedition" onchange="showCommentField(this.value)">
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
<div id="reclaimFile" style="display: <?=($arResult['EXPEDITION']['status'] == 11 ? 'block' : 'none')?>;">
Файл описания доработок: <input type="file" name="reclaimFile" id="reclaimFile" size="20"><br/>
<textarea name="reclaimComments" cols="50" rows="6"></textarea>
</div>
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
			<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
				<td><?=++$i?></td>
				<td><?=$file['create_date']?></td>
				<td><a target="_blank" href="/files/reclaim/<?=$file['name']?>"><?=$file['name']?></a></td>
				<td><?=$file['comments']?></td>
			</tr>
			<?
	}	
	echo '</table>';
}?>