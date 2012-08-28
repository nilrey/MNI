 <? $PAGE->setPageTitle('Запрос на экспедицию');?>
<?
	if(!empty($arResult['SEARCH']) ){
?>
<p style="padding: 5px 0px;">
<span style=" font-weight: bold; font-size: 14" href="/mni/index.php<?=$arResult['QSTRING']?>" >Результат поискового запроса:<br></span>
<?if(!empty($arResult['SEARCH']['kw_mni'])){?>
Ключевые слова в полях <br>"Название морских научных исследований" и "Цель морских научных исследований": "<?=str_replace( ' ', '", "',  $arResult['SEARCH']['kw_mni'])?>"<br>
<?}
if(!empty($arResult['SEARCH']['department'])){?>
Ведомство: 
	<? foreach ($arResult['REFBOOK']['departments'] as $item) { ?>
		<? if( $arResult['SEARCH']['department'] == $item['id']) echo "\"{$item['name']}\"" ;?>
	<? }?>

<br>
<?}
if(!empty($arResult['SEARCH']['kw_org'])){?>
Ключевые слова в названии организации: "<?=str_replace( ' ', '", "',  $arResult['SEARCH']['kw_org'])?>"<br>
<?}
?>
</p>
<p style="padding: 10px 0px;">
<a style=" font-weight: bold; font-size: 12" href="/mni/search.php?1=1<?=$arResult['QSTRING']?>" >&laquo; Вернуться к результатам поиска</a>
</p>
<?
	}
	?>
 <p>Количество записей: <? echo count($arResult['EXPEDITIONS']);?></p>
<? if(count($arResult['EXPEDITIONS']) > 0){?>
<TABLE CELLSPACING="0" CELLPADDING="0" CLASS="tab" STYLE="border: 1px solid #cdcdcd">
	<tr>
		<td class="head">№</td>
		<td class="head">Год</td>
		<td class="head">Начало</td>
		<td class="head">Окончание</td>
		<td class="head">Название МНИ</td>
		<td class="head">Статус МНИ</td>
	</tr>
	<?
	$i = 0;
	foreach ($arResult['EXPEDITIONS'] as $arItem) {
		$date = new DateTime($arItem['date_start']);
		$exp_year = $date->format('Y');
		?>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td onclick="window.location = 'expedition.php?eid=<?=$arItem['id'].$arResult['QSTRING']?>' "><center><?=++$i?></center></td>
		<td onclick="window.location = 'expedition.php?eid=<?=$arItem['id'].$arResult['QSTRING']?>' "><center><?=$exp_year?></center></td>
		<td onclick="window.location = 'expedition.php?eid=<?=$arItem['id'].$arResult['QSTRING']?>' "><center><?=$arItem['date_start']?></center></td>
		<td onclick="window.location = 'expedition.php?eid=<?=$arItem['id'].$arResult['QSTRING']?>' "><center><?=$arItem['date_end']?></center></td>
		<td onclick="window.location = 'expedition.php?eid=<?=$arItem['id'].$arResult['QSTRING']?>' "><a href="expedition.php?eid=<?=$arItem['id'].$arResult['QSTRING']?>"><?=$arItem['mni_name']?></td>
		<td onclick="window.location = 'expedition.php?eid=<?=$arItem['id'].$arResult['QSTRING']?>' "><center><?=( !empty($arResult['STATUS'][$arItem['status']]) ? $arResult['STATUS'][$arItem['status']] : '')?></center></td>
	</tr>
	<?}?>
</table>

<?}?>