			<p class="subtitle">1. Заявитель </p>
			<div class="border2px">
			<input type="hidden" name="APPLICANT[eid]" value="<?=$arResult['APPLICANT']['id']?>">
			<table border="0" cellspacing="0" cellpadding="0" class="tab">
				<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
					<td>Официальное название:</td><td>
					<strong><?=$arResult['APPLICANT']['fullname']?></strong>
					</td> 
				</tr>
				<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
					<td>Государство:</td><td>
						<? foreach ($arResult['REFBOOK']['countries'] as $item) { ?>
							<?=( ($arResult['APPLICANT']['country'] == $item['id']) ? $item['name'] : '')?>
						<? }?>
					</td> 
				</tr>
				<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
					<td>Принадлежность ведомству:</td><td>
						<? foreach ($arResult['REFBOOK']['departments'] as $item) { ?>
							<?=( ($arResult['APPLICANT']['department'] == $item['id']) ? $item['name'] : '')?>
						<? }?>
					</td> 
				</tr>
				<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
					<td>Город:</td><td><?=$arResult['APPLICANT']['city']?></td> 
				</tr>
				<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
					<td>Юридический адрес:</td><td><?=$arResult['APPLICANT']['legaladdress']?></td> 
				</tr>
				<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
					<td>Телефон:</td><td><?=$arResult['APPLICANT']['phone']?></td> 
				</tr>
				<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
					<td>Телефакс:</td><td><?=$arResult['APPLICANT']['fax']?></td> 
				</tr>
				<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
					<td>Телекс:</td><td><?=$arResult['APPLICANT']['telex']?></td> 
				</tr>
				<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
					<td>E-mail:</td><td><?=$arResult['APPLICANT']['email']?></td> 
				</tr>
			</table>  
			</div>