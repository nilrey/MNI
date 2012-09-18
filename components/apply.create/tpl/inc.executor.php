
			<p class="subtitle">2. Юридическое лицо (гражданин), уполномоченное на проведение морских научных исследований (заполняется в случае отличия от заявителя)</p>

			<p><input type="checkbox" name="EXECUTOR[isExecutor]" onchange="showExecutorBlock('isExecutor', 'executorBlock')" onclick="showExecutorBlock('isExecutor', 'executorBlock')" id="isExecutor" <?=(empty($arResult['EXECUTOR']['type']) ? '' : ' checked ')?>> <span onclick="checkIsExecutor('isExecutor', 'executorBlock')" style="cursor: default; padding: 5px">Исполнитель отличиется от заявителя</span></p>
			<div class="border2px" id="executorBlock" style="display:<?=(empty($arResult['EXECUTOR']['type']) ? ' none ' : ' block ')?>">
			<input type="hidden" name="EXECUTOR[eid]" value="<?=$arResult['EXECUTOR']['id']?>">
			<input type="hidden" name="EXECUTOR[curType]" value="<?=$arResult['EXECUTOR']['type']?>">
			<input type="radio" name="EXECUTOR[type]"  value="1" onchange="if(this.value == 1) {document.getElementById('executantOfficial').style.display = 'block'; document.getElementById('executantPerson').style.display = 'none'; } " onclick="if(this.value == 1) {document.getElementById('executantOfficial').style.display = 'block'; document.getElementById('executantPerson').style.display = 'none'; } " <?=($arResult['EXECUTOR']['type'] != 2 ? ' checked ' : '')?>>Юридическое
			<input type="radio" name="EXECUTOR[type]"  value="2" onchange="if(this.value == 2) {document.getElementById('executantOfficial').style.display = 'none'; document.getElementById('executantPerson').style.display = 'block'; } " onclick="if(this.value == 2) {document.getElementById('executantOfficial').style.display = 'none'; document.getElementById('executantPerson').style.display = 'block'; } " <?=($arResult['EXECUTOR']['type'] == 2 ? ' checked ' : '')?>>Физическое лицо
<br>
<br>
			<div id="executantOfficial" <?=($arResult['EXECUTOR']['type'] != 2 ? ' style="display: block" ' : ' style="display: none" ')?>>
			<table border="0" cellspacing="0" cellpadding="0" class="tab">
				<tr class="trHighLighted">
					<td><?=requiredTitle('Официальное название', 'executant_fullname')?>:</td><td>
					<input type="text" class="input_text" size="70" name="EXECUTOR[fullname]" id="executant_fullname" value="<?=htmlspecialchars($arResult['EXECUTOR']['fullname'])?>">
					</td>
				</tr>
				<tr class="trHighLighted">
					<td>Принадлежность ведомству:</td><td>
					<select class="input_text"  name="EXECUTOR[department]" id="executant_department">
						<option value="">
						<? foreach ($arResult['REFBOOK']['departments'] as $item) { ?>
							<option value="<?=$item['id']?>" <?=( ($arResult['EXECUTOR']['department'] == $item['id']) ? 'selected' : '')?>><?=$item['name']?>
						<? }?>
					</select>
					</td>
				</tr>
				<tr class="trHighLighted">
					<td><?=requiredTitle('Государство', 'executant_country')?>:</td><td id="placer_executant_country">
<? /*					<select class="input_text"  name="EXECUTOR[country]" id="executant_country">
						<option value="">
						<? foreach ($arResult['REFBOOK']['countries'] as $item) { ?>
							<option value="<?=$item['id']?>" <?=( ($arResult['EXECUTOR']['country'] == $item['id']) ? 'selected' : '')?>><?=$item['name']?>
						<? }?>
					</select>
*/?>
					</td>
				</tr>
				<tr class="trHighLighted">
					<td><?=requiredTitle('Город', 'executant_city')?>:</td><td><input type="text" size="70" class="input_text" name="EXECUTOR[city]" id="executant_city" value="<?=$arResult['EXECUTOR']['city']?>"></td>
				</tr>
				<tr class="trHighLighted">
					<td><?=requiredTitle('Юридический адрес', 'executant_legaladdress')?>:</td><td><TEXTAREA COLS="40" ROWS="4" class="input_text" name="EXECUTOR[legaladdress]" id="executant_legaladdress"><?=$arResult['EXECUTOR']['legaladdress']?></TEXTAREA></td>
				</tr>
				<tr class="trHighLighted">
					<td><?=requiredTitle('Телефон', 'executant_phone')?>:</td><td><input type="text" class="input_text" name="EXECUTOR[phone]" id="executant_phone" value="<?=$arResult['EXECUTOR']['phone']?>" size='70'></td>
				</tr>
				<tr class="trHighLighted">
					<td>Телефакс:</td><td><input type="text" class="input_text" name="EXECUTOR[fax]" id="executant_fax" value="<?=$arResult['EXECUTOR']['fax']?>" size='70'></td>
				</tr>
				<tr class="trHighLighted">
					<td>Телекс:</td><td><input type="text" class="input_text" name="EXECUTOR[telex]" id="executant_telex" value="<?=$arResult['EXECUTOR']['telex']?>" size='70'></td>
				</tr>
				<tr class="trHighLighted">
					<td><?=requiredTitle('E-mail', 'executant_email')?>:</td><td><input type="text" class="input_text" name="EXECUTOR[email]" id="executant_email" value="<?=$arResult['EXECUTOR']['email']?>" size='70'></td>
				</tr>
				<tr class="trHighLighted">
					<td>Skype:</td><td><input type="text" class="input_text" name="EXECUTOR[skype]" id="executant_skype" value="<?=$arResult['EXECUTOR']['skype']?>" size='70'></td>
				</tr>
				<tr class="trHighLighted">
					<td>Форма участия организации:</td><td>
					<?
					print htmlWrapper::getSelectSimple($arResult['REFBOOK']['org_particip'], "EXECUTOR[org_particip]", "executant_org_particip", 'onchange="if(this.value==8){$(\'#block_executant_org_particip_oth\').fadeIn(150)}else{$(\'#block_executant_org_particip_oth\').fadeOut(150); $(\'#executant_org_particip_oth\').val(\'\');}"', $arResult['EXECUTOR']['org_particip']);
					?>
					<div id="block_executant_org_particip_oth" style="display: <?=(empty($arResult['EXECUTOR']['org_particip_oth']) ? 'none' : 'block')?>">
					<input type="text" class="input_text" name="EXECUTOR[org_particip_oth]" id="executant_org_particip_oth" value="<?=$arResult['EXECUTOR']['org_particip_oth']?>" size='70'></div></td>
				</tr>
				<tr class="trHighLighted">
					<td>Количество представителей:</td><td><input type="text" class="input_text" name="EXECUTOR[org_particip_ammount]" id="executant_org_particip_ammount" value="<?=$arResult['EXECUTOR']['org_particip_ammount']?>"></td>
				</tr>
				<tr class="trHighLighted">
					<td>Форма участия представителей:</td><td><input type="text" class="input_text" name="EXECUTOR[org_particip_type]" id="executant_org_particip_type" value="<?=$arResult['EXECUTOR']['org_particip_type']?>" size='70'></td>
				</tr>
			</table>
			</div>
			<div id="executantPerson" <?=($arResult['EXECUTOR']['type'] == 2 ? ' style="display: block" ' : ' style="display: none" ')?>>
			<table border="0" cellspacing="0" cellpadding="0" class="tab">
				<tr class="trHighLighted">
					<td>Фамилия Имя Отчество:</td><td>
					<input type="text" class="input_text" size="70" name="EXECUTOR[fio]" id="executant_fio" value="<?=$arResult['EXECUTOR']['fio']?>">
					</td>
				</tr>
				<tr class="trHighLighted">
					<td>Гражданство:</td><td>
					<select class="input_text"  name="EXECUTOR[sitizen]" id="executant_sitizen">
						<option value="">
						<? foreach ($arResult['REFBOOK']['countries'] as $item) { ?>
							<option value="<?=$item['id']?>" <?=( ($arResult['EXECUTOR']['country'] == $item['id']) ? 'selected' : '')?>><?=$item['name']?>
						<? }?>
					</select>
					</td>
				</tr>
				<tr class="trHighLighted">
					<td>Место работы:</td><td><TEXTAREA COLS="40" ROWS="4" class="input_text" name="EXECUTOR[workaddress]" id="executant_workaddress"><?=$arResult['EXECUTOR']['workaddress']?></TEXTAREA></td>
				</tr>
				<tr class="trHighLighted">
					<td>Форма участия:</td><td><input type="text" class="input_text" name="EXECUTOR[particip]" id="executant_particip" value="<?=$arResult['EXECUTOR']['particip']?>"></td>
				</tr>
			</table>
			</div> <!-- \ executantPerson -->
			</div> <!-- \ border2px -->
			<script>$(document).ready( function(){
					$('#placer_executant_country').append(getCountriesSelect('EXECUTOR[country]', 'executant_country', '<?=$arResult['EXECUTOR']['country']?>', '') );
				});</script>