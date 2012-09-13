			<p class="subtitle">1. Заявитель </p>
			<div class="border2px">
			<input type="hidden" name="APPLICANT[eid]" value="<?=$arResult['APPLICANT']['id']?>">
			<table border="0" cellspacing="0" cellpadding="0" class="tab">
				<tr class="trHighLighted">
					<td><?=requiredTitle('Официальное название', 'applicant_fullname')?>:</td><td>
					<input type="text" class="input_text" size="70" name="APPLICANT[fullname]" id="applicant_fullname" value="<?=htmlspecialchars($arResult['APPLICANT']['fullname'])?>">
					</td>
				</tr>
				<tr class="trHighLighted">
					<td>Принадлежность ведомству:</td><td>
					<select class="input_text"  name="APPLICANT[department]" id="applicant_department">
						<option value="">
						<? foreach ($arResult['REFBOOK']['departments'] as $item) { ?>
							<option value="<?=$item['id']?>" <?=( ($arResult['APPLICANT']['department'] == $item['id']) ? 'selected' : '')?>><?=$item['name']?>
						<? }?>
					</select>
					</td>
				</tr>
				<tr class="trHighLighted">
					<td><?=requiredTitle('Государство', 'applicant_country')?>:</td><td id="placer_applicant_country">
					</td>
				</tr>
				<tr class="trHighLighted">
					<td><?=requiredTitle('Город', 'applicant_city')?>:</td><td><input type="text" size="70" class="input_text" name="APPLICANT[city]" id="applicant_city" value="<?=$arResult['APPLICANT']['city']?>"></td>
				</tr>
				<tr class="trHighLighted">
					<td><?=requiredTitle('Юридический адрес', 'applicant_legaladdress')?>:</td><td><TEXTAREA COLS="40" ROWS="4" class="input_text" name="APPLICANT[legaladdress]" id="applicant_legaladdress"><?=$arResult['APPLICANT']['legaladdress']?></TEXTAREA></td>
				</tr>
				<tr class="trHighLighted">
					<td><?=requiredTitle('Телефон', 'applicant_phone')?>:</td><td><input type="text" class="input_text" name="APPLICANT[phone]" id="applicant_phone" value="<?=$arResult['APPLICANT']['phone']?>" size='70'></td>
				</tr>
				<tr class="trHighLighted">
					<td>Телефакс:</td><td><input type="text" class="input_text" name="APPLICANT[fax]" id="applicant_fax" value="<?=$arResult['APPLICANT']['fax']?>" size='70'></td>
				</tr>
				<tr class="trHighLighted">
					<td>Телекс:</td><td><input type="text" class="input_text" name="APPLICANT[telex]" id="applicant_telex" value="<?=$arResult['APPLICANT']['telex']?>" size='70'></td>
				</tr>
				<tr class="trHighLighted">
					<td><?=requiredTitle('E-mail', 'applicant_email')?>:</td><td><input type="text" class="input_text" name="APPLICANT[email]" id="applicant_email" value="<?=$arResult['APPLICANT']['email']?>" size='70'></td>
				</tr>
				<tr class="trHighLighted">
					<td>Форма участия организации:</td><td>
					<?
					print htmlWrapper::getSelectSimple($arResult['REFBOOK']['org_particip'], "APPLICANT[org_particip]", "applicant_org_particip", 'onchange="if(this.value==8){$(\'#block_applicant_org_particip_oth\').fadeIn(150)}else{$(\'#block_applicant_org_particip_oth\').fadeOut(150); $(\'#applicant_org_particip_oth\').val(\'\');}"', $arResult['APPLICANT']['org_particip']);
					?>
					<div id="block_applicant_org_particip_oth" style="display: <?=(empty($arResult['APPLICANT']['org_particip_oth']) ? 'none' : 'block')?>">
					<input type="text" class="input_text" name="APPLICANT[org_particip_oth]" id="applicant_org_particip_oth" value="<?=$arResult['APPLICANT']['org_particip_oth']?>" size='70'></div>
					</td>
				</tr>
				<tr class="trHighLighted">
					<td>Количество представителей:</td><td><input type="text" class="input_text" name="APPLICANT[org_particip_ammount]" id="applicant_org_particip_ammount" value="<?=$arResult['APPLICANT']['org_particip_ammount']?>"></td>
				</tr>
				<tr class="trHighLighted">
					<td>Форма участия представителей:</td><td><input type="text" class="input_text" name="APPLICANT[org_particip_type]" id="applicant_org_particip_type" value="<?=$arResult['APPLICANT']['org_particip_type']?>" size='70'></td>
				</tr>
			</table>
			</div>
			<script>$(document).ready( function(){
					$('#placer_applicant_country').append(getCountriesSelect('APPLICANT[country]', 'applicant_country', <?=$arResult['APPLICANT']['country']?>, '') );
				});</script>