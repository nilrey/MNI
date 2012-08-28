			<p class="subtitle">1. Заявитель </p>
			<div class="border2px">
			<input type="hidden" name="APPLICANT[eid]" value="<?=$arResult['APPLICANT']['id']?>">
			<table border="0" cellspacing="0" cellpadding="0" class="tab">
				<tr class="trHighLighted">
					<td>Официальное название:</td><td>
					<strong><?=$arResult['APPLICANT']['fullname']?></strong>
					</td>
				</tr>
				<tr class="trHighLighted">
					<td>Государство:</td><td>
						<? foreach ($arResult['REFBOOK']['countries'] as $item) { ?>
							<?=( ($arResult['APPLICANT']['country'] == $item['id']) ? $item['name'] : '')?>
						<? }?>
					</td>
				</tr>
				<tr class="trHighLighted">
					<td>Принадлежность ведомству:</td><td>
						<? foreach ($arResult['REFBOOK']['departments'] as $item) { ?>
							<?=( ($arResult['APPLICANT']['department'] == $item['id']) ? $item['name'] : '')?>
						<? }?>
					</td>
				</tr>
				<tr class="trHighLighted">
					<td>Город:</td><td><?=$arResult['APPLICANT']['city']?></td>
				</tr>
				<tr class="trHighLighted">
					<td>Юридический адрес:</td><td><?=$arResult['APPLICANT']['legaladdress']?></td>
				</tr>
				<tr class="trHighLighted">
					<td>Телефон:</td><td><?=$arResult['APPLICANT']['phone']?></td>
				</tr>
				<tr class="trHighLighted">
					<td>Телефакс:</td><td><?=$arResult['APPLICANT']['fax']?></td>
				</tr>
				<tr class="trHighLighted">
					<td>Телекс:</td><td><?=$arResult['APPLICANT']['telex']?></td>
				</tr>
				<tr class="trHighLighted">
					<td>E-mail:</td><td><?=$arResult['APPLICANT']['email']?></td>
				</tr>
				<tr class="trHighLighted">
					<td>Форма участия организации:</td><td><?=$arResult['APPLICANT']['org_particip']?></td>
				</tr>
				<tr class="trHighLighted">
					<td>Количество представителей:</td><td><?=$arResult['APPLICANT']['org_particip_ammount']?></td>
				</tr>
				<tr class="trHighLighted">
					<td>Форма участия представителей:</td><td><?=$arResult['APPLICANT']['org_particip_type']?></td>
				</tr>
			</table>
			</div>