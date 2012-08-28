 <? //$PAGE->setPageTitle('Список запросов');?>
 <p>Количество записей: <? echo count($arResult['EXPEDITIONS']);?>
</p>
<?

	?>
<script>
function deleteExpedition(id){
	if(confirm('Хотите удалить запись?')){
		document.deleteForm.deleteId.value = id;
		document.deleteForm.submit();
	}
}


</script>
<!--<p class="subtitle">Список экспедиций</p>-->
<form name="deleteForm" method="POST">
<input type="hidden" name="deleteId" value="0">
</form>
<TABLE CELLSPACING="0" CELLPADDING="0" CLASS="tab" STYLE="border: 1px solid #cdcdcd">
	<tr>
		<td class="head">№</td>
		<td class="head">Год
		<select name="ORDERBY[year]" onchange="window.location='<?=$arResult['BASE_URL'].'&'?>ORDERBY[year]='+this.value;">
			<option value="0">Все
			<?
			if(!empty($arResult['YEARS'])){
				$to = substr($arResult['YEARS']['maxdate'], 0, 4);
				$from = substr($arResult['YEARS']['mindate'], 0, 4);
			for ($i=$from; $i<= $to ; $i++){
				$selected = '';
				if($arResult['ORDERBY']['year'] == $i){
					$selected = ' selected ';
				}
				?>
			<option value="<?=$i?>" <?=$selected?>><?=$i?>
			<?}
			}?>
		</select>

		</td>

		<td class="head"><a href="<?=$arResult['BASE_URL']?>&ORDERBY[fld]=date_start&ORDERBY[dir]=<?=( ($arResult['ORDERBY']['fld'] == 'date_start' && strtoupper($arResult['ORDERBY']['dir']) == 'DESC') ? 'asc' : 'desc')?>">Начало экспедиции</a><?=($arResult['ORDERBY']['fld'] == 'date_start' ? ($arResult['ORDERBY']['dir'] == 'desc' ? '<img src="'.TEMPLATE_PATH.'/images/arrow_down.gif">': '<img src="'.TEMPLATE_PATH.'/images/arrow_up.gif">') : null)?></td>

		<td class="head"><a href="<?=$arResult['BASE_URL']?>&ORDERBY[fld]=date_end&ORDERBY[dir]=<?=( ($arResult['ORDERBY']['fld'] == 'date_end' && strtoupper($arResult['ORDERBY']['dir']) == 'DESC') ? 'asc' : 'desc')?>">Окончание экспедиции</a><?=($arResult['ORDERBY']['fld'] == 'date_end' ? ($arResult['ORDERBY']['dir'] == 'desc' ? '<img src="'.TEMPLATE_PATH.'/images/arrow_down.gif">': '<img src="'.TEMPLATE_PATH.'/images/arrow_up.gif">') : null)?></td>
		<td class="head"><a href="<?=$arResult['BASE_URL']?>&ORDERBY[fld]=mni_name&ORDERBY[dir]=<?=( ($arResult['ORDERBY']['fld'] == 'mni_name' && strtoupper($arResult['ORDERBY']['dir']) == 'DESC') ? 'asc' : 'desc')?>">Название МНИ</a><?=($arResult['ORDERBY']['fld'] == 'mni_name' ? ($arResult['ORDERBY']['dir'] == 'desc' ? '<img src="'.TEMPLATE_PATH.'/images/arrow_down.gif">': '<img src="'.TEMPLATE_PATH.'/images/arrow_up.gif">') : null)?></td>
		<td class="head">Статус запроса
		<select name="ORDERBY[status]" onchange="window.location='<?=$arResult['BASE_URL'].'&'?>ORDERBY[status]='+this.value;">
			<option value="-1">Все
			<?
			if(!empty($arParams["STATUS"])){
			foreach ($arParams["STATUS"] as $status){
				$selected = '';
				if($arResult['ORDERBY']['status'] == $status){
					$selected = ' selected ';
				}
				?>
			<option value="<?=$status?>" <?=$selected?>><?=$arResult['STATUS'][$status]?>
			<?}
			}?>
		</select>

		</td>
		<td class="head">Копировать</a></td>
		<td class="head">Удалить</a></td>
	</tr>
	<?
if(count($arResult['EXPEDITIONS']) > 0){
	$i = 0;
	foreach ($arResult['EXPEDITIONS'] as $arItem) {
		$date = new DateTime($arItem['date_start']);
		$exp_year = $date->format('Y');
		?>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td onclick="window.location = 'apply.php?eid=<?=$arItem['id']?>' "><center><?=++$i?></center></td>
		<td onclick="window.location = 'apply.php?eid=<?=$arItem['id']?>' "><center><?=$exp_year?></center></td>
		<td onclick="window.location = 'apply.php?eid=<?=$arItem['id']?>' "><center><?=$arItem['date_start']?></center></td>
		<td onclick="window.location = 'apply.php?eid=<?=$arItem['id']?>' "><center><?=$arItem['date_end']?></center></td>
		<td onclick="window.location = 'apply.php?eid=<?=$arItem['id']?>' "><a href="apply.php?eid=<?=$arItem['id']?>"><?=$arItem['mni_name']?></td>
		<td onclick="window.location = 'apply.php?eid=<?=$arItem['id']?>' "><center><?=( !empty($arResult['STATUS'][$arItem['status']]) ? $arResult['STATUS'][$arItem['status']] : '')?></center></td>
		<td onclick="window.location = 'apply.php?eid=<?=$arItem['id']?>' "><center><a href="apply.php?eid=<?=$arItem['id']?>&act=copy"><img src="<?=TEMPLATE_PATH?>images/ico_index.gif" title="Копировать" alt="Копировать" border="0"></a></center></td>
		<td onclick="return false;"><center>
		<?if( in_array( $arItem['status'], array(0, 10, 11, 12, 13 ) ) ){
			?>
		<img src="<?=TEMPLATE_PATH?>images/cancel.gif" title="Удалить" alt="Удалить" border="0" onclick="deleteExpedition(<?=$arItem['id']?>)">
		<?
			}?>
		</center></td>
	</tr>
	<?}?>
<?}?>
</table>

