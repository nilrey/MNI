
 <p>Количество записей: <? echo count($arResult['USERS']);?>
</p>
<?if(count($arResult['USERS']) > 0){
	
	?>
<!--<p class="subtitle">Список экспедиций</p>-->
<form name="deleteForm" method="POST">
<input type="hidden" name="deleteId" value="0">
</form>
<TABLE CELLSPACING="0" CELLPADDING="0" CLASS="tab" STYLE="border: 1px solid #cdcdcd">
	<tr>
		<td class="head">ID</td>
		<td class="head">Имя</td>
		<td class="head">Логин</td>
		<td class="head">Группа</td>
		<td class="head">Активен</td>
	</tr>
	<?
	$i = 0;
	foreach ($arResult['USERS'] as $arItem) {
//		$date = new DateTime($arItem['date_start']);
//		$exp_year = $date->format('Y');
		?>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td onclick="window.location = 'edituser.php?eid=<?=$arItem['id']?>' "><center><?=$arItem['id']?></center></td>
		<td onclick="window.location = 'edituser.php?eid=<?=$arItem['id']?>' "><?=$arItem['name']?></td>
		<td onclick="window.location = 'edituser.php?eid=<?=$arItem['id']?>' "><center><?=$arItem['login']?></center></td>
		<td></td>
		<td></td>
	</tr>
	<?}?>
</table>

<?}?>