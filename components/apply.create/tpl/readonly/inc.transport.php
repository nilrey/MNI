		<p class="subtitle">4. Описание судна (другого транспортного средства), которое используется в морских научных исследованиях</p>
<?
//var_dump($arResult['MAINTRANSPORT']);
		if(!empty($arResult['MAINTRANSPORT'])){
			
			switch ($arResult['MAINTRANSPORT']['type']){
				case 'ship':
					
			$fields = '';
			$countriesList = '';
			foreach ($arResult['REFBOOK']['countries'] as $country){
				$selected = '';
				if($country['id'] == $arResult['MAINTRANSPORT']['nation']) $countriesList = $country['name'];
				
			}
			
			$counter = 1;
			$fields = '<tr onmouseover=\'this.style.background="#E6E6FA" onmouseout=\'this.style.background="#fff"\'><td>Название:</td><td>'.prepareString($arResult['MAINTRANSPORT']['name']).'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Национальность:</td><td>'.$countriesList.'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Судовладелец:</td><td>'.$arResult['MAINTRANSPORT']['shipowner'].'</td></tr>';	
			
			$countriesList = '';
			foreach ($arResult['REFBOOK']['countries'] as $country){
				if($country['id'] == $arResult['MAINTRANSPORT']['shipowner_country']) $countriesList = $country['name'];
			}
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td class=\'shiftLeft20\'>Государство:</td><td>
			'.$countriesList.'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td class=\'shiftLeft20\'>Город:</td><td>'.$arResult['MAINTRANSPORT']['shipowner_city'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td class=\'shiftLeft20\'>Юридический адрес:</td><td>'.$arResult['MAINTRANSPORT']['shipowner_legaladdress'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td class=\'shiftLeft20\'>Телефон:</td><td>'.$arResult['MAINTRANSPORT']['shipowner_phone'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td class=\'shiftLeft20\'>Телефакс:</td><td>'.$arResult['MAINTRANSPORT']['shipowner_fax'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td class=\'shiftLeft20\'>Телекс:</td><td>'.$arResult['MAINTRANSPORT']['shipowner_telex'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td class=\'shiftLeft20\'>E-mail:</td><td>'.$arResult['MAINTRANSPORT']['shipowner_email'].'</td></tr>';	
			
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Порт приписки:</td><td>'.$arResult['MAINTRANSPORT']['homeport'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Назначение:</td><td>'.$arResult['MAINTRANSPORT']['func'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Наибольшая длина:</td><td>'.$arResult['MAINTRANSPORT']['length'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Наибольшая ширина:</td><td>'.$arResult['MAINTRANSPORT']['width'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Наибольшая осадка:</td><td>'.$arResult['MAINTRANSPORT']['draught'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Мореходность:</td><td>'.$arResult['MAINTRANSPORT']['seaworth'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Полное водоизмещение:</td><td>'.$arResult['MAINTRANSPORT']['displace'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Тип и мощность главной энергетической установки:</td><td>'.$arResult['MAINTRANSPORT']['generator'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Радиочастоты:</td><td>'.$arResult['MAINTRANSPORT']['rdfreq'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Радиопозывные:</td><td>'.$arResult['MAINTRANSPORT']['rdsign'].'</td></tr>';	
			$fields .= '<tr><td  CLASS="head">Экипаж:</td><td  CLASS="head">&nbsp;</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Капитан:</td><td>'.$arResult['MAINTRANSPORT']['capt'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Команда:</td><td>'.$arResult['MAINTRANSPORT']['crew'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Экспедиционный состав:</td><td>'.$arResult['MAINTRANSPORT']['researchers'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Руководитель морских научных исследований:</td><td>'.$arResult['MAINTRANSPORT']['head'].'</td></tr>';	
					break;
					
				case 'other':
			$fields = '';
//			
//			foreach ($arResult['REFBOOK']['countries'] as $country){
//				$selected = '';
//				if($country['id'] == $arResult['MAINTRANSPORT']['nation']) $selected = ' selected ';
//				$countriesList .= "<option value='{$country['id']}' {$selected}>{$country['name']}";
//			}
			
			$counter = 1;
			$fields = '<tr onmouseover=\'this.style.background="#E6E6FA" onmouseout=\'this.style.background="#fff"\'><td>Название:</td><td>'.$arResult['MAINTRANSPORT']['name'].'</td></tr>';	
			$fields .= '<tr><td  CLASS="head">Экипаж:</td><td  CLASS="head">&nbsp;</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Капитан:</td><td>'.$arResult['MAINTRANSPORT']['capt'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Команда:</td><td>'.$arResult['MAINTRANSPORT']['crew'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Экспедиционный состав:</td><td>'.$arResult['MAINTRANSPORT']['researchers'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Руководитель морских научных исследований:</td><td>'.$arResult['MAINTRANSPORT']['head'].'</td></tr>';	
					
					break;	
			}
	
	$fields = '<div id="placerTransport1">Тип транспорта: '.($arResult['MAINTRANSPORT']['type'] == 'ship' ? ' Судно ' : '').($arResult['MAINTRANSPORT']['type'] == 'other' ? ' Другое ТС ' : '').'</div>
	<input type="hidden" name="TRANSPORT['.$counter.'][eid]" value="'.$arResult['MAINTRANSPORT']['id'].'">
	<input type="hidden" name="TRANSPORT['.$counter.'][curType]" value="'.$arResult['MAINTRANSPORT']['type'].'">
	<input type="hidden" name="TRANSPORT['.$counter.'][main_trs]" value="1">
	<div id="transp1">
	<div id="descTransport1">
	<TABLE CELLSPACING="0" CELLPADDING="0" CLASS="tab" STYLE="border: 1px solid #cdcdcd">'.$fields.'</table>
	</div>
	</div>
	';
	
	$fields .= "
<script type=\"text/javascript\">
	$(document).ready(function(){
	// --- Автозаполнение ---
	
	$(\"#shipname__{$counter}\").autocomplete(\"/ajax.php\", {
		delay:10,
		minChars:2,
		matchSubset:1,
		autoFill:false,
		matchContains:1,
		cacheLength:10,
		selectFirst:true,
		formatItem:liFormat,
		maxItemsToShow:10,
		onItemSelect:selectItemTransport,
		action:'getShipInfo',
		Counter:'{$counter}'
			}); 
	});
</script>		
<script type=\"text/javascript\">
	$(document).ready(function(){
	// --- Автозаполнение ---
	
	$(\"#shipowner__{$counter}\").autocomplete(\"/ajax_particip.php\", {
		delay:10,
		minChars:2,
		matchSubset:1,
		autoFill:false,
		matchContains:1,
		cacheLength:10,
		selectFirst:true,
		formatItem:liFormat,
		maxItemsToShow:10,
		onItemSelect:selectItemShipowner,
		action:'getParticipName',
		Counter:'{$counter}'
			}); 
	});
</script>			
	";
	
		echo $fields;
		
		}else{
?>		
		
		<div id="placerTransport1">Тип транспорта: <select name="TRANSPORT_NEW[1][type]" id="selTransport1" onchange="getTransportNewType(this, 1, 'transp1')"><option value=0 /><option value="ship">Судно<option value="other">Другое ТС</select><input type="hidden" name="TRANSPORT_NEW[1][main_trs]" value="1"></div>
		<div id="transp1">
			<div id="descTransport1"></div>
		</div>
		<?}?>
<br>
<br>
		<p class="subtitle">5. Описание судов (других транспортных средств), которые используются в морских научных исследованиях, наряду с судном (другим транспортным средством), указаным в пункте 4 (заполняется для каждого судна или транспортного средства отдельно)</p>
		<?
		if(!empty($arResult['TRANSPORT'])){
			echo '	<div id="transp2">';
			foreach ($arResult['TRANSPORT'] as $key => $arItem) {
				$counter = $key+2;
				$fields = '';
				switch ($arItem['type']){
					case 'ship':
//						var_dump($arItem);
						$fields = '';
			$countriesList = '';
			foreach ($arResult['REFBOOK']['countries'] as $country){
				if($country['id'] == $arItem['nation']) $countriesList = $country['name'];
				
			}
			
			$fields = '<tr onmouseover=\'this.style.background="#E6E6FA" onmouseout=\'this.style.background="#fff"\'><td>Название:</td><td>'.$arItem['name'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Национальность:</td><td>'.$countriesList.'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Судовладелец:</td><td>'.$arItem['shipowner'].'</td></tr>';	
			
			$countriesList = '';
			foreach ($arResult['REFBOOK']['countries'] as $country){
				if($country['id'] == $arItem['shipowner_country']) $countriesList = $country['name'];
			}
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td class=\'shiftLeft20\'>Государство:</td><td>
			'.$countriesList.'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td class=\'shiftLeft20\'>Город:</td><td>'.$arItem['shipowner_city'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td class=\'shiftLeft20\'>Юридический адрес:</td><td>'.$arItem['shipowner_legaladdress'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td class=\'shiftLeft20\'>Телефон:</td><td>'.$arItem['shipowner_phone'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td class=\'shiftLeft20\'>Телефакс:</td><td>'.$arItem['shipowner_fax'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td class=\'shiftLeft20\'>Телекс:</td><td>'.$arItem['shipowner_telex'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td class=\'shiftLeft20\'>E-mail:</td><td>'.$arItem['shipowner_email'].'</td></tr>';	
			
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Порт приписки:</td><td>'.$arItem['homeport'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Назначение:</td><td>'.$arItem['func'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Наибольшая длина:</td><td>'.$arItem['length'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Наибольшая ширина:</td><td>'.$arItem['width'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Наибольшая осадка:</td><td>'.$arItem['draught'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Мореходность:</td><td>'.$arItem['seaworth'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Полное водоизмещение:</td><td>'.$arItem['displace'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Тип и мощность главной энергетической установки:</td><td>'.$arItem['generator'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Радиочастоты:</td><td>'.$arItem['rdfreq'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Радиопозывные:</td><td>'.$arItem['rdsign'].'</td></tr>';	
			$fields .= '<tr><td  CLASS="head">Экипаж:</td><td  CLASS="head">&nbsp;</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Капитан:</td><td>'.$arItem['capt'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Команда:</td><td>'.$arItem['crew'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Экспедиционный состав:</td><td>'.$arItem['researchers'].'</td></tr>';	
			$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Руководитель морских научных исследований:</td><td>'.$arItem['head'].'</td></tr>';	
					
					break;
					case 'other':
						$fields = '<tr onmouseover=\'this.style.background="#E6E6FA" onmouseout=\'this.style.background="#fff"\'><td>Название:</td><td>'.prepareString($arItem['name']).'</td></tr>';	
						$fields .= '<tr><td  CLASS="head">Экипаж:</td><td  CLASS="head">&nbsp;</td></tr>';	
						$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Капитан:</td><td>'.$arItem['capt'].'</td></tr>';	
						$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Команда:</td><td>'.$arItem['crew'].'</td></tr>';	
						$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Экспедиционный состав:</td><td>'.$arItem['researchers'].'</td></tr>';	
						$fields .= '<tr onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'"><td>Руководитель морских научных исследований:</td><td>'.$arItem['head'].'</td></tr>';	
			
					break;

				}
			$fields = '
			<p><div id="placerTransport'.$counter.'"><strong>Тип транспорта: '.($arItem['type'] == 'ship' ? ' Судно ' : '').($arItem['type'] == 'other' ? ' Другое ТС' : '').'</strong></div></p>
	<input type="hidden" name="TRANSPORT['.$counter.'][eid]" value="'.$arItem['id'].'">
	<input type="hidden" name="TRANSPORT['.$counter.'][curType]" value="'.$arItem['type'].'">
	<input type="hidden" name="TRANSPORT['.$counter.'][main_trs]" value="0">
	
			<div id="descTransport'.$counter.'">
	<TABLE CELLSPACING="0" CELLPADDING="0" CLASS="tab" STYLE="border: 1px solid #cdcdcd">'.$fields.'</table>
	</div>';
			
			echo $fields;
			}
			echo '	</div>';
			?>
<? 	}else{ ?>
	<div id="transp2" style="border 1px solid #000">&nbsp;</div>
<?	} ?>
    
