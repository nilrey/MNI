		<p class="subtitle">3. Участники морских научных исследований, не являющиеся заявителем либо юридическим лицом (гражданином), уполномоченным на проведение исследований:</p>
		<?if( count($arResult['PARTICIPANT']) > 0 ){
			foreach ($arResult['PARTICIPANT'] as $counter=>$arItem){
				switch ($arItem['type']) {
					case 1:
$fields = "
<br>

		<div id='blockParticip{$counter}'>
			<div class=\"border2px\">
			<input type=\"hidden\" name=\"PARTICIPANT[{$counter}][eid]\" value=\"{$arItem['id']}\">
			<input type=\"hidden\" name=\"PARTICIPANT[{$counter}][curType]\" value=\"{$arItem['type']}\">
			<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"tab\">
				<tr class='trHighLighted'>
					<td>".requiredTitle('Официальное название', 'participant_fullname'.$counter).":</td><td>
					<input type=\"text\" class=\"input_text\" size=\"150\" name=\"PARTICIPANT[{$counter}][fullname]\" id=\"participant_fullname{$counter}\" value='{$arItem['fullname']}'>
					</td>
				</tr>
				<tr class='trHighLighted'>
					<td>Принадлежность ведомству:</td>
					<td id='placer_participant{$counter}_department'>
					</td>
				</tr>
				<tr class='trHighLighted'>
					<td>".requiredTitle('Государство', 'participant_country'.$counter).":</td>
					<td id='placer_participant{$counter}_country'>
					</td>
				</tr>
				<tr class='trHighLighted'>
					<td>".requiredTitle('Город', 'participant_city'.$counter).":</td><td><input type=\"text\" size=\"70\" class=\"input_text\" name=\"PARTICIPANT[{$counter}][city]\" id=\"participant_city{$counter}\" value=\"{$arItem['city']}\"></td>
				</tr>
				<tr class='trHighLighted'>
					<td>".requiredTitle('Юридический адрес', 'participant_legaladdress'.$counter).":</td><td><TEXTAREA COLS=\"40\" ROWS=\"4\" class=\"input_text\" name=\"PARTICIPANT[{$counter}][legaladdress]\" id=\"participant_legaladdress{$counter}\">{$arItem['legaladdress']}</TEXTAREA></td>
				</tr>
				<tr class='trHighLighted'>
					<td>".requiredTitle('Телефон', 'participant_phone'.$counter).":</td><td><input type=\"text\" class=\"input_text\" name=\"PARTICIPANT[{$counter}][phone]\" id=\"participant_phone{$counter}\" value=\"{$arItem['phone']}\" size='70'></td>
				</tr>
				<tr class='trHighLighted'>
					<td>Телефакс:</td><td><input type=\"text\" class=\"input_text\" name=\"PARTICIPANT[{$counter}][fax]\" id=\"participant_fax{$counter}\" value=\"{$arItem['fax']}\" size='70'></td>
				</tr>
				<tr class='trHighLighted'>
					<td>Телекс:</td><td><input type=\"text\" class=\"input_text\" name=\"PARTICIPANT[{$counter}][telex]\" id=\"participant_telex{$counter}\" value=\"{$arItem['telex']}\" size='70'></td>
				</tr>
				<tr class='trHighLighted'>
					<td>".requiredTitle('E-mail', 'participant_email'.$counter).":</td><td><input type=\"text\" class=\"input_text\" name=\"PARTICIPANT[{$counter}][email]\" id=\"participant_email{$counter}\" value=\"{$arItem['email']}\" size='70'></td>
				</tr>
				<tr class='trHighLighted'>
					<td>Skype:</td><td><input type=\"text\" class=\"input_text\" name=\"PARTICIPANT[{$counter}][skype]\" id=\"participant_skype{$counter}\" value=\"{$arItem['skype']}\" size='70'></td>
				</tr>
				<tr class='trHighLighted'>
					<td>Форма участия организации:</td><td>
					".htmlWrapper::getSelectSimple($arResult['REFBOOK']['org_particip'], "PARTICIPANT[{$counter}][org_particip]", "participant_org_particip{$counter}", 'onchange="if(this.value==8){$(\'#block_participant_org_particip_oth'.$counter.'\').fadeIn(150)}else{$(\'#block_participant_org_particip_oth'.$counter.'\').fadeOut(150); $(\'#participant_org_particip_oth'.$counter.'\').val(\'\');}"', $arItem['org_particip'])."
					<div id=\"block_participant_org_particip_oth{$counter}\" style=\"display: ".($arItem['org_particip'] == 8 ? 'block' : 'none')."\">
					<input type=\"text\" class=\"input_text\" name=\"PARTICIPANT[{$counter}][org_particip_oth]\" id=\"participant_org_particip_oth{$counter}\" value=\"{$arItem['org_particip_oth']}\" size='70'></div></td>
				</tr>
				<tr class='trHighLighted'>
					<td>Количество представителей:</td><td><input type=\"text\" class=\"input_text\" name=\"PARTICIPANT[{$counter}][org_particip_ammount]\" id=\"participant_org_particip_ammount{$counter}\" value=\"{$arItem['org_particip_ammount']}\"></td>
				</tr>
				<tr class='trHighLighted'>
					<td>Форма участия представителей:</td><td><input type=\"text\" class=\"input_text\" name=\"PARTICIPANT[{$counter}][org_particip_type]\" id=\"participant_org_particip_type{$counter}\" value=\"{$arItem['org_particip_type']}\" size='70'></td>
				</tr>
			</table>
			<script>$(document).ready( function(){
					$('#placer_participant{$counter}_country').append(getCountriesSelect('PARTICIPANT[{$counter}][country]', 'participant_country{$counter}', '".$arItem['country']."', '') );
					$('#placer_participant{$counter}_department').append(getDepartmentsSelect('PARTICIPANT[{$counter}][department]', 'participant_department{$counter}', '".$arItem['department']."', '') );
				});</script>
			<input type=\"button\" id=\"delParticip{$counter}\" onclick=\" if(confirmDeleteRecord()) deleteParticipBlockComplete({$counter}, {$arItem['id']}, {$arItem['type']})\" value=\"Удалить участника\">
			</div> <!-- \ border2px -->
			</div> <!-- \ participantPerson -->
<br>
<br>

<script type=\"text/javascript\">
	$(document).ready(function(){
	// --- Автозаполнение ---

//	$(\"#participant_fullname{$counter}\").autocomplete(\"/autocomplete.php\", {
	$(\"#participant_fullname{$counter}\").autocomplete(\"/ajax_particip.php\", {
		delay:10,
		minChars:2,
		matchSubset:1,
		autoFill:false,
		matchContains:1,
		cacheLength:10,
		selectFirst:true,
		formatItem:liFormat,
		maxItemsToShow:10,
		onItemSelect:selectItem,
		action:'getParticipName',
		Counter:'{$counter}'
			});
	});
</script>
			";
			break;
					case 2:
			$fields = "<div id='blockParticip{$counter}'>
			<div class=\"border2px\">
			<input type=\"hidden\" name=\"PARTICIPANT[{$counter}][eid]\" value=\"{$arItem['id']}\">
			<input type=\"hidden\" name=\"PARTICIPANT[{$counter}][curType]\" value=\"{$arItem['type']}\">

			<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"tab\">
				<tr class='trHighLighted'>
					<td>".requiredTitle('Фамилия Имя Отчество', 'participant_fio'.$counter).":</td><td>
					<input type=\"text\" class=\"input_text\" size=\"70\" name=\"PARTICIPANT[{$counter}][fio]\" id=\"participant_fio{$counter}\" value=\"{$arItem['fio']}\">
					</td>
				</tr>
				<tr class='trHighLighted'>
					<td>".requiredTitle('Гражданство', 'participant_sitizen'.$counter).":</td>
					<td id='placer_participant{$counter}_sitizen'>
					</td>
				</tr>
				<tr class='trHighLighted'>
					<td>".requiredTitle('Место работы', 'participant_workaddress'.$counter).":</td><td><TEXTAREA COLS=\"40\" ROWS=\"4\" class=\"input_text\" name=\"PARTICIPANT[{$counter}][workaddress]\" id=\"participant_workaddress{$counter}\">{$arItem['workaddress']}</TEXTAREA></td>
				</tr>
				<tr class='trHighLighted'>
					<td>".requiredTitle('Форма участия', 'participant_particip'.$counter).":</td><td><input type=\"text\" class=\"input_text\" name=\"PARTICIPANT[{$counter}][particip]\" id=\"participant_particip{$counter}\" value=\"{$arItem['particip']}\"></td>
				</tr>
			</table>
			<script>$(document).ready( function(){
					$('#placer_participant{$counter}_sitizen').append(getCountriesSelect('PARTICIPANT[{$counter}][sitizen]', 'participant_sitizen{$counter}', '".$arItem['country']."', '') );
				});</script>
			<input type=\"button\" id=\"delParticip{$counter}\" onclick=\" if(confirmDeleteRecord()) deleteParticipBlockComplete({$counter}, {$arItem['id']}, {$arItem['type']})\" value=\"Удалить участника\">
			</div> <!-- \ border2px -->
			</div> <!-- \ participantPerson -->
<br>
<br>

";
			break;
				}
echo $fields;
			}
		}?>
					 <div id="areaParticipant"></div>
<br>
<br>
<input type="button" onclick="getParticipBlock()" value="Добавить участника">