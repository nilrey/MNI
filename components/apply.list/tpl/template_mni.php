 <? //$PAGE->setPageTitle('Список запросов');?>
 <p>Количество записей: <? echo count($arResult['EXPEDITIONS']);?>
</p>
<?if(count($arResult['EXPEDITIONS']) > 0){
	
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
		<td class="head">Год</td>
		<td class="head">Начало</td>
		<td class="head">Окончание</td>
		<td class="head">Название МНИ</td>
		<td class="head">Статус МНИ</td>
		<td class="head">Копировать</td>
		<td class="head">Удалить</td>
	</tr>
	<?
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
</table>

<?}?>