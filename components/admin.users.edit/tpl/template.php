<? $PAGE->setSectionTitle('Список пользователей');?>
<script>
function sendForm(){
	document.frmEditUser.submit();
}
</script>
<? $PAGE->setPageTitle('Редактирование пользователя');?>
<?=(!empty($arResult['MESSAGE']) ? "<p>{$arResult['MESSAGE']}</p>" : '')?>
<form name='frmEditUser' method="POST">
<input type="hidden" name="eid" value="<?=($arResult['EDIT_USER']['id'] > 0 ? intval($arResult['EDIT_USER']['id']): '')?>">
<input type="hidden" name="EDIT_USER[active_orig]" value="<?=($arResult['EDIT_USER']['active'] > 0 ? intval($arResult['EDIT_USER']['active']): '')?>">
<TABLE CELLSPACING="0" CELLPADDING="0" CLASS="tab" STYLE="border: 1px solid #cdcdcd">
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td class="head">ID</td><td><p style="padding-left: 10px"><?=($arResult['EDIT_USER']['id'] > 0 ? intval($arResult['EDIT_USER']['id']): '')?></p></td>
	</tr>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td class="head">Активен</td><td><p style="padding-left: 10px"><input type="checkbox" name="EDIT_USER[active]" id="" <?=($arResult['EDIT_USER']['active'] > 0 ? ' checked ' : '')?>></p></td>
	</tr>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td class="head">Логин</td><td>
		<?if(intval($arResult['EDIT_USER']['id']) > 0){?>
		<strong style="padding-left: 10px"><?=prepareValue($arResult['EDIT_USER']['login'])?></strong>
		<?}else{?>
		<input type="text" name="EDIT_USER[login]">
		<?}?>
		</td>
	</tr>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td class="head">Имя</td><td><input type="text" name="EDIT_USER[name]" id="" value="<?=prepareValue($arResult['EDIT_USER']['name'])?>" size="50"></td>
	</tr>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td class="head">Пароль</td><td><input type="text" name="EDIT_USER[pass]" size="50"></td>
	</tr>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td class="head">
		E-mail
		</td>
		<td><input type="text" class="input_text" name="EDIT_USER[contactEmail]" id="contactEmail" value="<?=(!empty($arResult['EDIT_USER']['contactEmail']) ? $arResult['EDIT_USER']['contactEmail'] : '')?>">
		</td>
	</tr>
	<tr>
		<td class="head">Группы</td>
		<td>
			<?
			if(isset($arResult['GROUPS']) && count($arResult['GROUPS']) > 0){
				foreach ($arResult['GROUPS'] as $group){
					$selected = '';
					if(isset($arResult['EDIT_USER']['groups']) && count($arResult['EDIT_USER']['groups']) > 0){
						foreach ($arResult['EDIT_USER']['groups'] as $ugroup) {
							if($ugroup["group_id"] == $group['id']){
								$selected = 'checked';
							}
						}
					}
					?>
					<p style="padding-left: 10px"><?=$group['id']?>&nbsp;<input type="checkbox" name="groups[]" value="<?=$group['id']?>" <?=$selected?>>&nbsp;<?=$group['name']?></p>
					<?
				}
			}
			?>
		</td>
	</tr>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td class="head">Полное название организации</td><td><input type="text" name="EDIT_USER[orgNameFull]" id="" value="<?=prepareValue($arResult['EDIT_USER']['orgNameFull'])?>" size="50"></td>
	</tr>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td class="head">Краткое название организации</td><td><input type="text" name="EDIT_USER[orgNameShort]" id="" value="<?=prepareValue($arResult['EDIT_USER']['orgNameShort'])?>" size="50"></td>
	</tr>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td class="head">Принадлежность ведомству <td>
		<select class="input_text"  name="EDIT_USER[department]" id="orgDepartment">
			<option value="">
			<? foreach ($arResult['REFBOOK']['departments'] as $item) { ?>
				<option value="<?=$item['id']?>" <?=( ($arResult['EDIT_USER']['orgDepartment'] == $item['id']) ? 'selected' : '')?>><?=$item['name']?>
			<? }?>
		</select>
		</td>
	</tr>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td class="head">Страна принадлежности</td>
		<td>
		<select class="input_text"  name="EDIT_USER[country]" id="country">
			<option value="">
			<? foreach ($arResult['REFBOOK']['countries'] as $item) { ?>
				<option value="<?=$item['id']?>" <?=( ($arResult['EDIT_USER']['country'] == $item['id']) ? 'selected' : '')?>><?=$item['name']?>
			<? }?>
		</select>
		</td>
	</tr>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td class="head">
		Город
		</td>
		<td><input type="text" class="input_text"  name="EDIT_USER[adrCity]" id="adrCity" value="<?=(!empty($arResult['EDIT_USER']['city']) ? $arResult['EDIT_USER']['city'] : '')?>">
		</td>
	</tr>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td class="head">
		Юридический адрес
		</td>
		<td><textarea name="EDIT_USER[legalAddress]" id="legalAddress" cols="40" rows="4" class="input_text"><?=(!empty($arResult['EDIT_USER']['legalAddress']) ? $arResult['EDIT_USER']['legalAddress'] : '')?></textarea>
		</td>
	</tr>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td class="head">
		Телефон
		</td>
		<td><input type="text" class="input_text"  name="EDIT_USER[phone]" id="phone" value="<?=(!empty($arResult['EDIT_USER']['phone']) ? $arResult['EDIT_USER']['phone'] : '')?>">
		</td>
	</tr>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td class="head">
		Факс
		</td>
		<td><input type="text" class="input_text"  name="EDIT_USER[fax]" id="fax" value="<?=(!empty($arResult['EDIT_USER']['fax']) ? $arResult['EDIT_USER']['fax'] : '')?>">
		</td>
	</tr>

	<tr>
		<td colspan="2"><p><input type="button" onclick="sendForm()" value="Изменить"></p></td>
	</tr>
</table>
</form>