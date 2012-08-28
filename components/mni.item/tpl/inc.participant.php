
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
				<tr onmouseover=\"this.style.background='#E6E6FA'\" onmouseout=\"this.style.background='#fff'\">
					<td>Официальное название:</td><td>
					{$arItem['fullname']}
					</td> 
				</tr>
				<tr onmouseover=\"this.style.background='#E6E6FA'\" onmouseout=\"this.style.background='#fff'\">
					<td>Государство:</td><td>
						{$countriesList}
					</td> 
				</tr>
				<tr onmouseover=\"this.style.background='#E6E6FA'\" onmouseout=\"this.style.background='#fff'\">
					<td>Город:</td><td>{$arItem['city']}</td> 
				</tr>
				<tr onmouseover=\"this.style.background='#E6E6FA'\" onmouseout=\"this.style.background='#fff'\">
					<td>Юридический адрес:</td><td>{$arItem['legaladdress']}</td> 
				</tr>
				<tr onmouseover=\"this.style.background='#E6E6FA'\" onmouseout=\"this.style.background='#fff'\">
					<td>Телефон:</td><td>{$arItem['phone']}</td> 
				</tr>
				<tr onmouseover=\"this.style.background='#E6E6FA'\" onmouseout=\"this.style.background='#fff'\">
					<td>Телефакс:</td><td>{$arItem['fax']}</td> 
				</tr>
				<tr onmouseover=\"this.style.background='#E6E6FA'\" onmouseout=\"this.style.background='#fff'\">
					<td>Телекс:</td><td>{$arItem['telex']}</td> 
				</tr>
				<tr onmouseover=\"this.style.background='#E6E6FA'\" onmouseout=\"this.style.background='#fff'\">
					<td>E-mail:</td><td>{$arItem['email']}</td> 
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
				<tr onmouseover=\"this.style.background='#E6E6FA'\" onmouseout=\"this.style.background='#fff'\">
					<td>Фамилия Имя Отчество:</td><td>
					{$arItem['fio']}
					</td> 
				</tr>
				<tr onmouseover=\"this.style.background='#E6E6FA'\" onmouseout=\"this.style.background='#fff'\">
					<td>Гражданство:</td><td>
						{$countriesList}
					</td> 
				</tr>
				<tr onmouseover=\"this.style.background='#E6E6FA'\" onmouseout=\"this.style.background='#fff'\">
					<td>Место работы:</td><td>{$arItem['workaddress']}</td> 
				</tr>
				<tr onmouseover=\"this.style.background='#E6E6FA'\" onmouseout=\"this.style.background='#fff'\">
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
