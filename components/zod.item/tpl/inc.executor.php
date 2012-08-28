
			<p class="subtitle">2. Юридическое лицо (гражданин), уполномоченное на проведение морских научных исследований (заполняется в случае отличия от заявителя)</p>
			<div class="border2px">
			<input type="hidden" name="EXECUTOR[eid]" value="<?=$arResult['EXECUTOR']['id']?>">
			<input type="hidden" name="EXECUTOR[curType]" value="<?=$arResult['EXECUTOR']['type']?>">
			<?=($arResult['EXECUTOR']['type'] != 2 ? ' Юридическое  лицо ' : '')?>
			<?=($arResult['EXECUTOR']['type'] == 2 ? ' Физическое  лицо ' : '')?>
<br>
<br>
			<div id="executantOfficial" <?=($arResult['EXECUTOR']['type'] != 2 ? ' style="display: block" ' : ' style="display: none" ')?>>
			<table border="0" cellspacing="0" cellpadding="0" class="tab">
				<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
					<td>Официальное название:</td><td>
					 <strong><?=$arResult['EXECUTOR']['fullname']?></strong>
					</td> 
				</tr>
				<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
					<td>Государство:</td><td>
						<? foreach ($arResult['REFBOOK']['countries'] as $item) { ?>
							<?=( ($arResult['EXECUTOR']['country'] == $item['id']) ? $item['name'] : '')?>
						<? }?>
					</td> 
				</tr>
				<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
					<td>Город:</td><td><?=$arResult['EXECUTOR']['city']?></td> 
				</tr>
				<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
					<td>Юридический адрес:</td><td><?=$arResult['EXECUTOR']['legaladdress']?></td> 
				</tr>
				<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
					<td>Телефон:</td><td><?=$arResult['EXECUTOR']['phone']?></td> 
				</tr>
				<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
					<td>Телефакс:</td><td><?=$arResult['EXECUTOR']['fax']?></td> 
				</tr>
				<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
					<td>Телекс:</td><td><?=$arResult['EXECUTOR']['telex']?></td> 
				</tr>
				<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
					<td>E-mail:</td><td><?=$arResult['EXECUTOR']['email']?></td> 
				</tr>
			</table>  
			</div>
			<div id="executantPerson" <?=($arResult['EXECUTOR']['type'] == 2 ? ' style="display: block" ' : ' style="display: none" ')?>>
			<table border="0" cellspacing="0" cellpadding="0" class="tab">
				<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
					<td>Фамилия Имя Отчество:</td><td>
					 <strong><?=$arResult['EXECUTOR']['fio']?> </strong>
					</td> 
				</tr>
				<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
					<td>Гражданство:</td><td>
						<? foreach ($arResult['REFBOOK']['countries'] as $item) { ?>
						 	<?=( ($arResult['EXECUTOR']['country'] == $item['id']) ? $item['name'] : '')?>
						<? }?>
					</td> 
				</tr>
				<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
					<td>Место работы:</td><td> <?=$arResult['EXECUTOR']['workaddress']?></td> 
				</tr>
				<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
					<td>Форма участия:</td><td><?=$arResult['EXECUTOR']['particip']?></td> 
				</tr>
			</table>  
			</div> <!-- \ executantPerson -->
			</div> <!-- \ border2px -->