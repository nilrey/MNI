<? $PAGE->setSectionTitle('Кабинет пользователя');
$PAGE->setPageTitle('Профиль. Иземение персональных данных');?>
<?if( isset($arResult['MESSAGE']) ){
		echo $arResult['MESSAGE'];
}
?>
<form class="form" name="frmReg" method="post" >
<table border="0">
	<tr>
	   <td class="main_content" COLSPAN="2">
			<DIV class="form_name">Данные по организации</DIV>
			<HR class="form_underline">
		</td>
	</tr>
	<tr>
		<td class="main_content">
		<span class="element_name">Наименование полное</span>
		</td>
		<td><input type="text" class="input_text"  name="EDIT_USER[orgNameFull]" id="orgNameFull" value="<?=(!empty($arResult['EDIT_USER']['orgNameFull']) ? $arResult['EDIT_USER']['orgNameFull'] : '')?>" size="70">
		</td>
	</tr>
	<tr>
		<td class="main_content">
		<span class="element_name">Наименование краткое</span>
		</td>
		<td><input type="text" class="input_text"  name="EDIT_USER[orgNameShort]" id="orgNameShort" value="<?=(!empty($arResult['EDIT_USER']['orgNameShort']) ? $arResult['EDIT_USER']['orgNameShort'] : '')?>">
		</td>
	</tr>
	<tr>
		<td class="main_content">
		<span class="element_name">Принадлежность ведомству</span>
		<td>
		<select class="input_text"  name="EDIT_USER[orgDepartment]" id="orgDepartment">
			<option value="">
			<? foreach ($arResult['REFBOOK']['departments'] as $item) { ?>
				<option value="<?=$item['id']?>" <?=( ($arResult['EDIT_USER']['orgDepartment'] == $item['id']) ? 'selected' : '')?>><?=$item['name']?>
			<? }?>
		</select>
		</td>
	</tr>
	<tr>
		<td class="main_content">
		<span class="element_name">Страна принадлежности</span>
		</td>
		<td>
		<select class="input_text"  name="EDIT_USER[country]" id="country">
			<option value="">
			<? foreach ($arResult['REFBOOK']['countries'] as $item) { ?>
				<option value="<?=$item['id']?>" <?=( ($arResult['EDIT_USER']['country'] == $item['id']) ? 'selected' : '')?>><?=$item['name']?>
			<? }?>
		</select>
		</td>
	</tr>
	<tr>
		<td class="main_content">
		<span class="element_name">Город</span>
		</td>
		<td><input type="text" class="input_text"  name="EDIT_USER[city]" id="city" value="<?=(!empty($arResult['EDIT_USER']['city']) ? $arResult['EDIT_USER']['city'] : '')?>">
		</td>
	</tr>
	<tr>
		<td class="main_content">
		<span class="element_name">Юридический адрес</span>
		</td>
		<td><textarea name="EDIT_USER[legalAddress]" id="legalAddress" cols="40" rows="4" class="input_text"><?=(!empty($arResult['EDIT_USER']['legalAddress']) ? $arResult['EDIT_USER']['legalAddress'] : '')?></textarea>
		</td>
	</tr>
	<tr>
		<td class="main_content">
		<span class="element_name">Телефон</span>
		</td>
		<td><input type="text" class="input_text"  name="EDIT_USER[phone]" id="phone" value="<?=(!empty($arResult['EDIT_USER']['phone']) ? $arResult['EDIT_USER']['phone'] : '')?>">
		</td>
	</tr>
	<tr>
		<td class="main_content">
		<span class="element_name">Факс</span>
		</td>
		<td><input type="text" class="input_text"  name="EDIT_USER[fax]" id="fax" value="<?=(!empty($arResult['EDIT_USER']['fax']) ? $arResult['EDIT_USER']['fax'] : '')?>">
		</td>
	</tr>
	<tr>
		<td class="main_content">
		<span class="element_name">Телекс</span>
		</td>
		<td><input type="text" class="input_text"  name="EDIT_USER[telex]" id="telex" value="<?=(!empty($arResult['EDIT_USER']['telex']) ? $arResult['EDIT_USER']['telex'] : '')?>">
		</td>
	</tr>
	<tr>
	   <td class="main_content" COLSPAN="2">
			<DIV class="form_name">Контактные данные</DIV>
			<HR class="form_underline">
		</td>
	</tr>
	<tr>
		<td class="main_content">
		<span class="element_name">Контактное лицо</span>
		</td>
		<td><input type="text" class="input_text"  name="EDIT_USER[contactName]" id="contactName" value="<?=(!empty($arResult['EDIT_USER']['name']) ? $arResult['EDIT_USER']['name'] : '')?>" size="70">
		</td>
	</tr>
	<tr>
		<td class="main_content">
		<span class="element_name">Телефон</span>
		</td>
		<td><input type="text" class="input_text" name="EDIT_USER[contactPhone]" id="contactPhone" value="<?=(!empty($arResult['EDIT_USER']['contactPhone']) ? $arResult['EDIT_USER']['contactPhone'] : '')?>">
		</td>
	</tr>
	<tr>
		<td class="main_content">
		<span class="element_name">E-mail</span>
		</td>
		<td><input type="text" class="input_text" name="EDIT_USER[contactEmail]" id="contactEmail" value="<?=(!empty($arResult['EDIT_USER']['contactEmail']) ? $arResult['EDIT_USER']['contactEmail'] : '')?>">
		</td>
	</tr>
	<tr>
	   <td class="main_content" COLSPAN="2">
			<DIV class="form_name">Сменить пароль</DIV>
			<HR class="form_underline">
		</td>
	</tr>
	<tr>
		<td class="main_content">
		<span class="element_name">Пароль</span>
		</td>
		<td><input type="password" class="input_text" name="EDIT_USER[password]" id="password" >
		</td>
	</tr>
	<tr>
		<td class="main_content">
		<span class="element_name">Подтверждение пароля</span>
		</td>
		<td><input type="password" class="input_text" name="EDIT_USER[confirmPassword]" id="confirmPassword" >
		</td>
	</tr>

	<tr>
		<td colspan="2" class="main_content">
			<hr class="form_underline">
			<CENTER><input type="button" VALUE="Отправить" Style="font-weight: bold" class="btn" onclick="this.form.submit()">&nbsp;&nbsp;&nbsp;
			<input type="button" VALUE="Очистить" class="btn" onclick="this.form.reset()"></CENTER>
		</td>
	</tr>

</table>
</form>

