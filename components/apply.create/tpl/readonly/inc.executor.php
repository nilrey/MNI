
			<p class="subtitle">2. Юридическое лицо (гражданин), уполномоченное на проведение морских научных исследований (заполняется в случае отличия от заявителя)</p>
			<div class="border2px">
			<?if($arResult['EXECUTOR']['type'] == 1 ){ ?>

			<p>Юридическое  лицо</p>
<br>
<br>
			<div id="executantOfficial" <?=($arResult['EXECUTOR']['type'] != 2 ? ' style="display: block" ' : ' style="display: none" ')?>>
			<table border="0" cellspacing="0" cellpadding="0" class="tab">
				<tr class="trHighLighted">
					<td>Официальное название:</td><td>
					 <strong><?=$arResult['EXECUTOR']['fullname']?></strong>
					</td>
				</tr>
				<tr class="trHighLighted">
					<td>Государство:</td><td>
						<? foreach ($arResult['REFBOOK']['countries'] as $item) { ?>
							<?=( ($arResult['EXECUTOR']['country'] == $item['id']) ? $item['name'] : '')?>
						<? }?>
					</td>
				</tr>
				<tr class="trHighLighted">
					<td>Город:</td><td><?=$arResult['EXECUTOR']['city']?></td>
				</tr>
				<tr class="trHighLighted">
					<td>Юридический адрес:</td><td><?=$arResult['EXECUTOR']['legaladdress']?></td>
				</tr>
				<tr class="trHighLighted">
					<td>Телефон:</td><td><?=$arResult['EXECUTOR']['phone']?></td>
				</tr>
				<tr class="trHighLighted">
					<td>Телефакс:</td><td><?=$arResult['EXECUTOR']['fax']?></td>
				</tr>
				<tr class="trHighLighted">
					<td>Телекс:</td><td><?=$arResult['EXECUTOR']['telex']?></td>
				</tr>
				<tr class="trHighLighted">
					<td>E-mail:</td><td><?=$arResult['EXECUTOR']['email']?></td>
				</tr>
				<tr class="trHighLighted">
					<td>Форма участия организации:</td><td><?=$arResult['EXECUTOR']['org_particip']?></td>
				</tr>
				<tr class="trHighLighted">
					<td>Количество представителей:</td><td><?=$arResult['EXECUTOR']['org_particip_ammount']?></td>
				</tr>
				<tr class="trHighLighted">
					<td>Форма участия представителей:</td><td><?=$arResult['EXECUTOR']['org_particip_type']?></td>
				</tr>
			</table>
			</div>
			<? }elseif ($arResult['EXECUTOR']['type'] == 2 ) {?>
			<p>Физическое  лицо</p>
<br>
<br>
			<div id="executantPerson" <?=($arResult['EXECUTOR']['type'] == 2 ? ' style="display: block" ' : ' style="display: none" ')?>>
			<table border="0" cellspacing="0" cellpadding="0" class="tab">
				<tr class="trHighLighted">
					<td>Фамилия Имя Отчество:</td><td>
					 <strong><?=$arResult['EXECUTOR']['fio']?> </strong>
					</td>
				</tr>
				<tr class="trHighLighted">
					<td>Гражданство:</td><td>
						<? foreach ($arResult['REFBOOK']['countries'] as $item) { ?>
						 	<?=( ($arResult['EXECUTOR']['country'] == $item['id']) ? $item['name'] : '')?>
						<? }?>
					</td>
				</tr>
				<tr class="trHighLighted">
					<td>Место работы:</td><td> <?=$arResult['EXECUTOR']['workaddress']?></td>
				</tr>
				<tr class="trHighLighted">
					<td>Форма участия:</td><td><?=$arResult['EXECUTOR']['particip']?></td>
				</tr>
			</table>
			</div> <!-- \ executantPerson -->
			<?}else{
				?>
<p>Совпадает с Заявителем (п.1)</p>
				<?
			}?>
			</div> <!-- \ border2px -->