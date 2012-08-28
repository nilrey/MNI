<? $PAGE->setSectionTitle('Список пользователей');?>
<script>
function sendForm(){
	document.frmEditUser.submit();
}
</script>
<? $PAGE->setPageTitle('Редактирование пользователя');?>
<?=(!empty($arResult['ERROR']) ? "<p>{$arResult['ERROR']}</p>" : '')?>
<form name='frmEditUser' method="POST">
<input type="hidden" name="eid" value="<?=($arResult['EDIT_GROUP']['id'] > 0 ? intval($arResult['EDIT_GROUP']['id']): '')?>">
<TABLE CELLSPACING="0" CELLPADDING="0" CLASS="tab" STYLE="border: 1px solid #cdcdcd">
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td class="head" style="text-align: right">ID</td><td><p style="padding-left: 10px"><?=($arResult['EDIT_GROUP']['id'] > 0 ? intval($arResult['EDIT_GROUP']['id']): '')?></p></td> 
	</tr>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td class="head" style="text-align: right">Активен</td><td><p style="padding-left: 10px"><input type="checkbox" name="active" id="" <?=($arResult['EDIT_GROUP']['active'] > 0 ? ' checked ' : '')?>></p></td> 
	</tr>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td class="head" style="text-align: right">Название группы</td><td><input type="text" name="name" id="" value="<?=prepareValue($arResult['EDIT_GROUP']['name'])?>" size="50"></td> 
	</tr>
	<tr>
		<td class="head" style="text-align: right">Отношение к видам морских исследований</td>
		<td>
			<?
			if(isset($arResult['GROUPS']) && count($arResult['GROUPS']) > 0){
				foreach ($arResult['GROUPS'] as $group){
					$selected = '';
					if(isset($arResult['EDIT_GROUP']['mnitype']) && count($arResult['EDIT_GROUP']['mnitype']) > 0){
						foreach ($arResult['EDIT_GROUP']['mnitype'] as $mnitype) {
							if($mnitype["mnitype"] == $group['code']){
								$selected = 'checked';
							}
						}
					}
					?>
					<p style="padding-left: 10px"><input type="checkbox" name="mnitype[]" value="<?=$group['code']?>" <?=$selected?>>&nbsp;<?=$group['name']?></p>
					<?
				}
			}
			?>
		</td>
	</tr>
	
	<tr>
		<td colspan="2"><p><input type="button" onclick="sendForm()" value="Изменить"></p></td>
	</tr>
</table>
</form>