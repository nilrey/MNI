 <? $PAGE->setPageTitle('Запрос на экспедицию');?>
 <p>Количество записей: <? echo count($arResult['EXPEDITIONS']);?>
</p>
<?if(count($arResult['EXPEDITIONS']) > 0){
	
	?>
<!--<p class="subtitle">Список экспедиций</p>-->
<form name="deleteForm" method="POST">
<input type="hidden" name="deleteId" value="0">
</form>
<TABLE CELLSPACING="0" CELLPADDING="0" CLASS="tab" STYLE="border: 1px solid #cdcdcd">
	<tr>
		<td class="head">№</td>
		<td class="head">Год</td>
		<td class="head">Начало экспедиции</td>
		<td class="head">Окончание экспедиции</td>
		<td class="head">Название МНИ</td>
		<td class="head">Статус запроса</td>
	</tr>
	<?
	$i = 0;
	foreach ($arResult['EXPEDITIONS'] as $arItem) {
		$date = new DateTime($arItem['date_start']);
		$exp_year = $date->format('Y');
		?>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td onclick="window.location = 'mon_exp_item.php?eid=<?=$arItem['id']?>' "><center><?=++$i?></center></td>
		<td onclick="window.location = 'mon_exp_item.php?eid=<?=$arItem['id']?>' "><center><?=$exp_year?></center></td>
		<td onclick="window.location = 'mon_exp_item.php?eid=<?=$arItem['id']?>' "><center><?=$arItem['date_start']?></center></td>
		<td onclick="window.location = 'mon_exp_item.php?eid=<?=$arItem['id']?>' "><center><?=$arItem['date_end']?></center></td>
		<td onclick="window.location = 'mon_exp_item.php?eid=<?=$arItem['id']?>' "><a href="mon_exp_item.php?eid=<?=$arItem['id']?>"><?=$arItem['mni_name']?></td>
		<td onclick="window.location = 'mon_exp_item.php?eid=<?=$arItem['id']?>' "><center><?=( !empty($arResult['STATUS'][$arItem['status']]) ? $arResult['STATUS'][$arItem['status']] : '')?></center></td>
	</tr>
	<?}?>
</table>

<?}?>