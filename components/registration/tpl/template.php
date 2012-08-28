<? $PAGE->setSectionTitle('Кабинет пользователя');
$PAGE->setPageTitle('Регистрация');?>
<?if (!$arResult['REGISTRATION_RESULT']){?>
<?if( isset($arResult['ERRORS']) ){
		echo $arResult['ERRORS'];
}
?>
<form class="form" name="frmReg" method="post" >
<input type="hidden" name="saveReg" value="1">
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
		<td><input type="text" class="input_text"  name="REGFORM[orgNameFull]" id="orgNameFull" value="<?=(!empty($arResult['VARIABLES']['orgNameFull']) ? $arResult['VARIABLES']['orgNameFull'] : '')?>" size="70">
		</td>
	</tr>
	<tr>
		<td class="main_content">
		<span class="element_name">Наименование краткое</span>
		</td>
		<td><input type="text" class="input_text"  name="REGFORM[orgNameShort]" id="orgNameShort" value="<?=(!empty($arResult['VARIABLES']['orgNameShort']) ? $arResult['VARIABLES']['orgNameShort'] : '')?>">
		</td>
	</tr>
	<tr>
		<td class="main_content">
		<span class="element_name">Принадлежность ведомству</span>
		<td>
		<select class="input_text"  name="REGFORM[department]" id="orgDepartment">
			<option value="">
			<? foreach ($arResult['REFBOOK']['departments'] as $item) { ?>
				<option value="<?=$item['id']?>"><?=$item['name']?>
			<? }?>
		</select>
		</td>
	</tr>
	<tr>
		<td class="main_content">
		<span class="element_name">Страна принадлежности</span>
		</td>
		<td>
		<select class="input_text"  name="REGFORM[country]" id="country">
			<option value="">
			<? foreach ($arResult['REFBOOK']['countries'] as $item) { ?>
				<option value="<?=$item['id']?>" <?=( ($arResult['VARIABLES']['country'] == $item['id']) ? 'selected' : '')?>><?=$item['name']?>
			<? }?>
		</select>
		</td>
	</tr>
	<tr>
		<td class="main_content">
		<span class="element_name">Город</span>
		</td>
		<td><input type="text" class="input_text"  name="REGFORM[adrCity]" id="adrCity" value="<?=(!empty($arResult['VARIABLES']['adrCity']) ? $arResult['VARIABLES']['adrCity'] : '')?>">
		</td>
	</tr>
	<tr>
		<td class="main_content">
		<span class="element_name">Юридический адрес</span>
		</td>
		<td><textarea name="REGFORM[legalAddress]" id="legalAddress" cols="40" rows="4" class="input_text"><?=(!empty($arResult['VARIABLES']['legalAddress']) ? $arResult['VARIABLES']['legalAddress'] : '')?></textarea>
		</td>
	</tr>
	<tr>
		<td class="main_content">
		<span class="element_name">Телефон</span>
		</td>
		<td><input type="text" class="input_text"  name="REGFORM[phone]" id="phone" value="<?=(!empty($arResult['VARIABLES']['phone']) ? $arResult['VARIABLES']['phone'] : '')?>">
		</td>
	</tr>
	<tr>
		<td class="main_content">
		<span class="element_name">Факс</span>
		</td>
		<td><input type="text" class="input_text"  name="REGFORM[fax]" id="fax" value="<?=(!empty($arResult['VARIABLES']['fax']) ? $arResult['VARIABLES']['fax'] : '')?>">
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
		<td><input type="text" class="input_text"  name="REGFORM[contactName]" id="contactName" value="<?=(!empty($arResult['VARIABLES']['name']) ? $arResult['VARIABLES']['name'] : '')?>" size="70">
		</td>
	</tr>
	<tr>
		<td class="main_content">
		<span class="element_name">Телефон</span>
		</td>
		<td><input type="text" class="input_text" name="REGFORM[contactPhone]" id="contactPhone" value="<?=(!empty($arResult['VARIABLES']['contactPhone']) ? $arResult['VARIABLES']['contactPhone'] : '')?>">
		</td>
	</tr>
	<tr>
		<td class="main_content">
		<span class="element_name">E-mail</span>
		</td>
		<td><input type="text" class="input_text" name="REGFORM[contactEmail]" id="contactEmail" value="<?=(!empty($arResult['VARIABLES']['contactEmail']) ? $arResult['VARIABLES']['contactEmail'] : '')?>">
		</td>
	</tr>
	<tr>
	   <td class="main_content" COLSPAN="2">
			<DIV class="form_name">Регистационные данные</DIV>
			<HR class="form_underline">
		</td>
	</tr>
	<tr>
		<td class="main_content">
		<span class="element_name">Логин</span>
		</td>
		<td><input type="text" class="input_text" name="REGFORM[login]" id="login" value="<?=(!empty($arResult['VARIABLES']['login']) ? $arResult['VARIABLES']['login'] : '')?>">
		</td>
	</tr>
	<tr>
		<td class="main_content">
		<span class="element_name">Пароль</span>
		</td>
		<td><input type="password" class="input_text" name="REGFORM[password]" id="password" >
		</td>
	</tr>
	<tr>
		<td class="main_content">
		<span class="element_name">Подтверждение пароля</span>
		</td>
		<td><input type="password" class="input_text" name="REGFORM[confirmPassword]" id="confirmPassword" >
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

<?}else{ ?>

Спасибо, ваши данные приняты в обработку. Инструкции по активации аккаунта высланы на ваш контактный email.

<? }?>