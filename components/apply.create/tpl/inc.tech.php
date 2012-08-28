<p class="subtitle">11. Технические средства морс ких научных исследований (основные характеристики, официальное наименование и юридический адрес владельца), за исключением предусмотренных пунктом 12 </p>
<div class="shiftLeft20">
<input type="hidden" name="TECH[eid]" value="<?=$arResult['TECH']['exp_id']?>">
<table class="tab" style="border: 0px">
	<tr class="trHighLighted">
		<td>а) <?=requiredTitle('гидрографические', 'tech_hydrograph', false)?> </td><td>
		<textarea name="TECH[hydrograph]" id="tech_hydrograph" ><?=(!empty($arResult['TECH']['hydrograph']) ? $arResult['TECH']['hydrograph'] : 'нет' )?></textarea></td>
	</tr>

	<tr class="trHighLighted">
		<td>б) <?=requiredTitle('гидроакустические', 'tech_hydroacustic', false)?> </td><td>
		<textarea name="TECH[hydroacustic]" id="tech_hydroacustic"><?=(!empty($arResult['TECH']['hydroacustic']) ? $arResult['TECH']['hydroacustic'] : 'нет' )?></textarea></td>
	</tr>

	<tr class="trHighLighted">
		<td>в) <?=requiredTitle('магнитометрические', 'tech_magnitometr', false)?> </td><td>
		<textarea name="TECH[magnitometr]" id="tech_magnitometr"><?=(!empty($arResult['TECH']['magnitometr']) ? $arResult['TECH']['magnitometr'] : 'нет' )?></textarea></td>
	</tr>

	<tr class="trHighLighted">
		<td>г) <?=requiredTitle('сейсмические', 'tech_seismic', false)?> </td><td>
		<textarea name="TECH[seismic]" id="tech_seismic"><?=(!empty($arResult['TECH']['seismic']) ? $arResult['TECH']['seismic'] : 'нет' )?></textarea></td>
	</tr>

	<tr class="trHighLighted">
		<td>д) <?=requiredTitle('метеорологические', 'tech_meteorolog', false)?> </td><td>
		<textarea name="TECH[meteorolog]" id="tech_meteorolog"><?=(!empty($arResult['TECH']['meteorolog']) ? $arResult['TECH']['meteorolog'] : 'нет' )?></textarea></td>
	</tr>

	<tr class="trHighLighted">
		<td>ж) <?=requiredTitle('океанографические', 'tech_oceanograph', false)?> </td><td>
		<textarea name="TECH[oceanograph]" id="tech_oceanograph"><?=(!empty($arResult['TECH']['oceanograph']) ? $arResult['TECH']['oceanograph'] : 'нет' )?></textarea></td>
	</tr>

	<tr class="trHighLighted">
		<td>з) <?=requiredTitle('оборудование для<br>
 биологических исследований', 'tech_bioresearch', false)?> </td><td>
		<textarea name="TECH[bioresearch]" id="tech_bioresearch"><?=(!empty($arResult['TECH']['bioresearch']) ? $arResult['TECH']['bioresearch'] : 'нет' )?></textarea></td>
	</tr>

	<tr class="trHighLighted">
		<td>и) <?=requiredTitle('оборудование для взятия<br> проб воды, грунта, донных отложений, <br>биологических и других проб', 'tech_probation', false)?> </td><td>
		<textarea name="TECH[probation]" id="tech_probation"><?=(!empty($arResult['TECH']['probation']) ? $arResult['TECH']['probation'] : 'нет' )?></textarea></td>
	</tr>

	<tr class="trHighLighted">
		<td>к) <?=requiredTitle('ныряющие устройства', 'tech_divingdev', false)?> </td><td>
		<textarea name="TECH[divingdev]" id="tech_divingdev"><?=(!empty($arResult['TECH']['divingdev']) ? $arResult['TECH']['divingdev'] : 'нет' )?></textarea></td>
	</tr>

	<tr class="trHighLighted">
		<td>л) <?=requiredTitle('заякоренные устройства', 'tech_ancoreddev', false)?> </td><td>
		<textarea name="TECH[ancoreddev]" id="tech_ancoreddev"><?=(!empty($arResult['TECH']['ancoreddev']) ? $arResult['TECH']['ancoreddev'] : 'нет' )?></textarea></td>
	</tr>

	<tr class="trHighLighted">
		<td>м) <?=requiredTitle('буксируемые устройства', 'tech_coupleddev', false)?> </td><td>
		<textarea name="TECH[coupleddev]" id="tech_coupleddev"><?=(!empty($arResult['TECH']['coupleddev']) ? $arResult['TECH']['coupleddev'] : 'нет' )?></textarea></td>
	</tr>

	<tr class="trHighLighted">
		<td>н) <?=requiredTitle('обитаемые и необитаемые <br>аппараты', 'tech_submarine', false)?> </td><td>
		<textarea name="TECH[submarine]" id="tech_submarine"><?=(!empty($arResult['TECH']['submarine']) ? $arResult['TECH']['submarine'] : 'нет' )?></textarea></td>
	</tr>

	<tr class="trHighLighted">
		<td>о) <?=requiredTitle('летательные аппараты', 'tech_planes', false)?> </td><td>
		<textarea name="TECH[planes]" id="tech_planes"><?=(!empty($arResult['TECH']['planes']) ? $arResult['TECH']['planes'] : 'нет' )?></textarea></td>
	</tr>

	<tr class="trHighLighted">
		<td>п) <?=requiredTitle('другое оборудование', 'tech_otherdev', false)?> </td><td>
		<textarea name="TECH[otherdev]" id="tech_otherdev"><?=(!empty($arResult['TECH']['otherdev']) ? $arResult['TECH']['otherdev'] : 'нет' )?></textarea></td>
	</tr>
</table>
</div>
<br>
<br>
<p class="subtitle">12. Независимые автоматические научно-исследовательские устрановки и оборудование</p>
<p><input type="checkbox" name="EQUIP[isEquipment]" onchange="showExecutorBlock('isEquipment', 'equipmentArea')" onclick="showExecutorBlock('isEquipment', 'equipmentArea')" id="isEquipment" <?=(count($arResult['EQUIP']) > 0 ? ' checked ' : '')?>> <span onclick="checkIsExecutor('isEquipment', 'equipmentArea')" style="cursor: default; padding: 5px">Задействованы</span></p>

<div id="equipmentArea" style="display:<?=(count($arResult['EQUIP']) > 0 ? ' block ' : ' none ')?>">
<?
//var_dump($arResult['COORDS']['equip']);
$fields = '';
if( count($arResult['EQUIP']) > 0 ){
			foreach ($arResult['EQUIP'] as $key=>$arItem){
				$counter = $key;
				$equip_basic = requiredTitle('а) основные характеристики', 'equip_basic'.$counter);
				$equip_infotype = requiredTitle('б) характер получаемой информации и способ ее передачи', 'equip_infotype'.$counter);
				$equip_coord = requiredTitle('в-г) географические координаты (в градусах, минутах и долях минут) района использования (места постановки)', 'equip_coord'.$counter);
//				$equip_dates = requiredTitle('г) даты (YYYY-MM-DD) постановки и демотажа, время действия', 'equip_dates'.$counter);
//				$equip_owner = requiredTitle('д) официальное наименование и юридический адрес владельца', 'equip_owner'.$counter);

				$coordType = 'equip';
				$rows = '';
//				echo '<pre>';print_r($arResult['COORDS'][$coordType]);echo '</pre>';
				if( count($arResult['COORDS'][$coordType]) > 0 ){
					$trCounter = 0;
					foreach ($arResult['COORDS'][$coordType] as $keyCoord=>$arCoord){
						if($arCoord['block'] == $arItem['block']){
						$counterCoord = $keyCoord;
						$trCounter++;
						list($latGrad, $latMin) = explode(';', $arCoord['latitiude']);
						list($langGrad, $langMin, $langType) = explode(';', $arCoord['langitude']);
						$checkType1 = '';
						$checkType2 = '';
						$langType == 'в.д.' ? $checkType1 = ' checked ' : $checkType2 = ' checked ';
						$equip_install = '';
						$equip_deinstall = '';
						if( checkStringDate($arCoord['equip_install']) ){
							$equip_install = $arCoord['equip_install'];
						}
						if( checkStringDate($arCoord['equip_deinstall']) ){
							$equip_deinstall = $arCoord['equip_deinstall'];
						}
				$rows .= <<<TEXT
				<tr id="trEq{$counterCoord}">
				<td>{$trCounter}</td>
				<td><input type="text" name="COORDS[{$coordType}][{$counterCoord}][info]" id="{$coordType}{$counterCoord}usage_place" onchange="dpFormatValue(this)" value="{$arCoord['info']}" class="input100"><input type="hidden" name="COORDS[{$coordType}][{$counterCoord}][block]" id="{$coordType}_block" value="{$counter}">
				<input type="hidden" name="COORDS[{$coordType}][{$counterCoord}][num]" id="{$coordType}_num" value="{$trCounter}">
				</td>
				<td><input type="text" size="1" name="COORDS[{$coordType}][{$counterCoord}][lat_grad]" id="{$coordType}{$counterCoord}lat_grad" onkeyup="checkCoord('{$coordType}{$counterCoord}lat_grad', '{$coordType}{$counterCoord}lat_min')"  maxlength="3" value="{$latGrad}">&#176&nbsp;&nbsp;&nbsp;<input type="text" size="3" name="COORDS[{$coordType}][{$counterCoord}][lat_min]" id="{$coordType}{$counterCoord}lat_min" onkeyup="checkCoord('{$coordType}{$counterCoord}lat_min', '')"  maxlength="6" value="{$latMin}">&#39 с.ш.
				</td>
				<td>
				<input type="text" size="1" name="COORDS[{$coordType}][{$counterCoord}][lang_grad]" id="{$coordType}{$counterCoord}lang_grad" onkeyup="checkCoord('{$coordType}{$counterCoord}lang_grad', '{$coordType}{$counterCoord}lang_min')"  maxlength="3" value="{$langGrad}">&#176&nbsp;&nbsp;&nbsp;<input type="text" size="3" name="COORDS[{$coordType}][{$counterCoord}][lang_min]" id="{$coordType}{$counterCoord}lang_min" onkeyup="checkCoord('{$coordType}{$counterCoord}lang_min', '')"  maxlength="6" value="{$langMin}">&#39<input type="radio" name="COORDS[{$coordType}][{$counterCoord}][lang_type]" value="в.д." {$checkType1}>в.д.<input type="radio" name="COORDS[{$coordType}][{$counterCoord}][lang_type]" value="з.д." {$checkType2}>з.д.
				</td>
				<td><input type="text" name="COORDS[{$coordType}][{$counterCoord}][equip_install]" id="{$coordType}{$counterCoord}equip_install" value="{$equip_install}" size=7></td>
				<td><input type="text" name="COORDS[{$coordType}][{$counterCoord}][equip_deinstall]" id="{$coordType}{$counterCoord}equip_deinstall" value="{$equip_deinstall}" size=7></td>
				<td><textarea name="COORDS[{$coordType}][{$counterCoord}][time_usage]" id="{$coordType}{$counterCoord}time_usage" style="width: 185px; height: 22px">{$arCoord['time_usage']}</textarea></td>
				<td>
				<input type="button" id="equipButton" onclick=" if(confirmDelete()) {deleteEquipTrComplete({$counterCoord}, '{$coordType}', {$arCoord['id']}, this ) }" value="Удалить">
				</td>
				</tr>

TEXT;

				$scripts .= "
$('#{$coordType}{$counterCoord}equip_install').datepick({ minDate: cMinDate, maxDate: cMaxDate, showTrigger: '#calImg'});
$('#{$coordType}{$counterCoord}equip_deinstall').datepick({ minDate: cMinDate, maxDate: cMaxDate, showTrigger: '#calImg'});
setTextareaResizeNew('{$coordType}{$counterCoord}time_usage', 185, 22, 300, newHeight);
";
						}
					}
				}

$COORDS = <<<TEXT
 <table id="tableequip" class="tab">
 <tbody>
 <tr>
 	<td class="head">№ точки</td>
 	<td class="head">Район<br />использования</td>
 	<td class="head">Географическая<br />широта<br />(в градусах,<br />минутах и<br />долях минут)</td>
 	<td class="head">Географическая<br />долгота<br />(в градусах,<br />минутах и<br />долях минут)</td>
 	<td class="head">Дата<br />постановки</td>
 	<td class="head">Дата<br />демонтажа</td>
 	<td class="head">Время<br />действия</td>
 	<td class="head">&nbsp</td>
 </tr>
 $rows
 </tbody>
</table>
<input type="button" onclick="addCoordsEquipTr({$counter})" value="Добавить запись">
<p style="vertical-align: top">Дополнительная информация: <textarea class="input_text" name="EQUIP[{$counter}][comments]" id="comments{$counter}" style="width: 500px; height: 22px">{$arItem['comments']}</textarea></p>
<br/>
TEXT;

$scripts .= "setTextareaResizeNew('comments{$counter}', 500, 22, 500, newHeight);";

/* DO NOT TAB OR ALIGN*/

foreach ($arResult['REFBOOK']['countries'] as $country) {
	$strOutputCountries .= "<option value='{$country['id']}' ";
	$arItem['equipowner_country'] == $country['id'] ? $selected = 'selected' : $selected = '';
	$strOutputCountries .= $selected.'>'.$country['name'];
}


				$fields .= <<<TEXT
		<div id='blockEquip{$counter}'>
			<div class="border2px">
			<input type="hidden" name="EQUIP[{$counter}][eid]" value="{$arItem['id']}">
			<table border="0" cellspacing="0" cellpadding="0" class="tab">
				<tr class="trHighLighted">
					<td width="30%">{$equip_basic}:</td>
					<td><textarea type="text" class="input_text" name="EQUIP[{$counter}][basic]" id="equip_basic{$counter}" style="width: 500px; height: 22px">{$arItem['basic']}</textarea>
					</td>
				</tr>
				<tr class="trHighLighted">
					<td width="30%">{$equip_infotype}:</td>
					<td><textarea type="text" class="input_text" name="EQUIP[{$counter}][infotype]" id="equip_infotype{$counter}" style="width: 500px; height: 22px">{$arItem['infotype']}</textarea>
					</td>
				</tr>
				<tr>
					<td colspan="2"><p>{$equip_coord}:</p>
					$COORDS
					</td>
				</tr>
				<tr>
					<td colspan="2"><p>д) официальное наименование и юридический адрес владельца:</p></td>
				</tr>
				<tr class="trHighLighted">
					<td width="30%">Наименование организации:</td>
					<td><textarea class="input_text" name="EQUIP[{$counter}][equipowner]" id="equipowner{$counter}" style="width: 500px; height: 22px">{$arItem['equipowner']}</textarea>
					</td>
				</tr>
				<tr class="trHighLighted">
					<td width="30%">Страна:</td>
					<td>
					<select class="input_text"  name="EQUIP[{$counter}][equipowner_country]" id="equipowner_country{$counter}">
						<option value="">{$strOutputCountries}
					</select>
					</td>
				</tr>
				<tr class="trHighLighted">
					<td width="30%">Город:</td>
					<td>
					<input type="text" class="input_text" name="EQUIP[{$counter}][equipowner_city]" id="equipowner_city{$counter}" value="{$arItem['equipowner_city']}" >
					</td>
				</tr>
				<tr class="trHighLighted">
					<td width="30%">Юр. адрес организации:</td>
					<td><textarea class="input_text" name="EQUIP[{$counter}][equipowner_legaladdress]" id="equipowner_legaladdress{$counter}" style="width: 500px; height: 22px">{$arItem['equipowner_legaladdress']}</textarea>
					</td>
				</tr>
				<tr class="trHighLighted">
					<td width="30%">Телефон:</td>
					<td>
					<input type="text" class="input_text" name="EQUIP[{$counter}][equipowner_phone]" id="equipowner_phone{$counter}" value="{$arItem['equipowner_phone']}" >
					</td>
				</tr>
				<tr class="trHighLighted">
					<td width="30%">Факс:</td>
					<td>
					<input type="text" class="input_text" name="EQUIP[{$counter}][equipowner_fax]" id="equipowner_fax{$counter}" value="{$arItem['equipowner_fax']}" >
					</td>
				</tr>
				<tr class="trHighLighted">
					<td width="30%">E-mail:</td>
					<td>
					<input type="text" class="input_text" name="EQUIP[{$counter}][equipowner_email]" id="equipowner_email{$counter}" value="{$arItem['equipowner_email']}" >
					</td>
				</tr>
			</table>
			</div>
			<input type="button" onclick=" if(confirmDeleteRecord()) deleteEquipBlockComplete({$counter}, 'equip', {$arItem['id']})" value="Удалить оборудование">
			<br>
			<br>
		</div>
TEXT;

				$scripts .= "
	setTextareaResizeNew('equip_basic{$counter}', txtWidth, txtHeight, txtWidth, newHeight);
	setTextareaResizeNew('equip_infotype{$counter}', txtWidth, txtHeight, txtWidth, newHeight);
	setTextareaResizeNew('equipowner{$counter}', txtWidth, txtHeight, txtWidth, newHeight);
	setTextareaResizeNew('equipowner_legaladdress{$counter}', txtWidth, txtHeight, txtWidth, newHeight);
";

			}

}
echo $fields;
echo "<script>{$scripts}</script>";
 $scripts = "";
?>

</div>

<input type="button" id="addTo_equipmentArea" onclick="addEquipBlock('equip')" value="Ноовое оборудование" style="display:<?=(count($arResult['EQUIP']) > 0 ? ' block ' : ' none ')?>">
<br>
<br>
