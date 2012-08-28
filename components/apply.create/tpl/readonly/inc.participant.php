
		<p class="subtitle">3. Участники морских научных исследований, не являющиеся заявителем либо юридическим лицом (гражданином), уполномоченным на проведение исследований:</p>
		<?if( count($arResult['PARTICIPANT']) > 0 ){
			foreach ($arResult['PARTICIPANT'] as $counter=>$arItem){
				$countriesList = '';
				foreach ($arResult['REFBOOK']['countries'] as $country){
					$selected = '';
					if($country['id'] == $arItem['country']) $countriesList = $country['name'];

				}
				switch ($arItem['type']) {
					case 1:
$fields = "
<br>

		<div id='blockParticip{$counter}'>
			<div class=\"border2px\">
			<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"tab\">
				<tr class='trHighLighted'>
					<td>Официальное название:</td><td>
					{$arItem['fullname']}
					</td>
				</tr>
				<tr class='trHighLighted'>
					<td>Государство:</td><td>
						{$countriesList}
					</td>
				</tr>
				<tr class='trHighLighted'>
					<td>Город:</td><td>{$arItem['city']}</td>
				</tr>
				<tr class='trHighLighted'>
					<td>Юридический адрес:</td><td>{$arItem['legaladdress']}</td>
				</tr>
				<tr class='trHighLighted'>
					<td>Телефон:</td><td>{$arItem['phone']}</td>
				</tr>
				<tr class='trHighLighted'>
					<td>Телефакс:</td><td>{$arItem['fax']}</td>
				</tr>
				<tr class='trHighLighted'>
					<td>Телекс:</td><td>{$arItem['telex']}</td>
				</tr>
				<tr class='trHighLighted'>
					<td>E-mail:</td><td>{$arItem['email']}</td>
				</tr>
				<tr class='trHighLighted'>
					<td>Форма участия организации:</td><td>{$arItem['org_particip']}</td>
				</tr>
				<tr class='trHighLighted'>
					<td>Количество представителей:</td><td>{$arItem['org_particip_ammount']}</td>
				</tr>
				<tr class='trHighLighted'>
					<td>Форма участия представителей:</td><td>{$arItem['org_particip_type']}</td>
				</tr>

			</table>
			</div> <!-- \ border2px -->
<br>
<br>
</div>
			";
			break;
					case 2:
			$fields = "<div id='blockParticip{$counter}'>
			<div class=\"border2px\">

			<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"tab\">
				<tr class='trHighLighted'>
					<td>Фамилия Имя Отчество:</td><td>
					{$arItem['fio']}
					</td>
				</tr>
				<tr class='trHighLighted'>
					<td>Гражданство:</td><td>
						{$countriesList}
					</td>
				</tr>
				<tr class='trHighLighted'>
					<td>Место работы:</td><td>{$arItem['workaddress']}</td>
				</tr>
				<tr class='trHighLighted'>
					<td>Форма участия:</td><td>{$arItem['particip']}</td>
				</tr>
			</table>
			</div> <!-- \ executerPerson -->
<br>
<br>
			</div> <!-- \ border2px -->
";
			break;
				}
echo $fields;
			}
		}?>
					 <div id="areaParticipant"></div>
<br>
<br>
