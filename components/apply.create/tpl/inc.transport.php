		<p class="subtitle">4. Описание судна (другого транспортного средства), которое используется в морских научных исследованиях</p>
<?
//var_dump($arResult['MAINTRANSPORT']);
		if(!empty($arResult['MAINTRANSPORT'])){

			switch ($arResult['MAINTRANSPORT']['type']){
				case 'ship':
					$fields = '';
					$counter = 1;
					$fields = '<tr class="trHighLighted"><td>'.requiredTitle('Название', 'shipname__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][shipname]" id="shipname__'.$counter.'" size=100 value="'.prepareString($arResult['MAINTRANSPORT']['name']).'"></td></tr>';
					$fields .= '<tr class="trHighLighted">
							<td>'.requiredTitle('Национальность', 'nation__'.$counter).':</td>
							<td id="placer_mtrans_nation'.$counter.'">
							</td></tr>';
					$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Судовладелец', 'shipowner__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][shipowner]" id="shipowner__'.$counter.'" value="'.$arResult['MAINTRANSPORT']['shipowner'].'" size="80"></td></tr>';

					$fields .= '<tr class="trHighLighted"><td class=\'shiftLeft20\'>'.requiredTitle('Государство', 'shipowner_country__'.$counter).':</td>
							<td id="placer_mtrans_shipowner'.$counter.'_country">
							</td>
							</tr>';
					$fields .= '<tr class="trHighLighted"><td class=\'shiftLeft20\'>'.requiredTitle('Город', 'shipowner_city__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][shipowner_city]" id="shipowner_city__'.$counter.'" value="'.$arResult['MAINTRANSPORT']['shipowner_city'].'"></td></tr>';
					$fields .= '<tr class="trHighLighted"><td class=\'shiftLeft20\'>'.requiredTitle('Юридический адрес', 'shipowner_legaladdress__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][shipowner_legaladdress]" id="shipowner_legaladdress__'.$counter.'" value="'.$arResult['MAINTRANSPORT']['shipowner_legaladdress'].'"></td></tr>';
					$fields .= '<tr class="trHighLighted"><td class=\'shiftLeft20\'>'.requiredTitle('Телефон', 'shipowner_phone__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][shipowner_phone]" id="shipowner_phone__'.$counter.'" value="'.$arResult['MAINTRANSPORT']['shipowner_phone'].'" size="70"></td></tr>';
					$fields .= '<tr class="trHighLighted"><td class=\'shiftLeft20\' size="70">Телефакс:</td><td><input type="text" name="TRANSPORT['.$counter.'][shipowner_fax]" id="shipowner_fax__'.$counter.'" value="'.$arResult['MAINTRANSPORT']['shipowner_fax'].'" size="70"></td></tr>';
					$fields .= '<tr class="trHighLighted"><td class=\'shiftLeft20\' size="70">Телекс:</td><td><input type="text" name="TRANSPORT['.$counter.'][shipowner_telex]" id="shipowner_telex__'.$counter.'" value="'.$arResult['MAINTRANSPORT']['shipowner_telex'].'" size="70"></td></tr>';
					$fields .= '<tr class="trHighLighted"><td class=\'shiftLeft20\'>'.requiredTitle('E-mail', 'shipowner_email__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][shipowner_email]" id="shipowner_email__'.$counter.'" value="'.$arResult['MAINTRANSPORT']['shipowner_email'].'" size="70"></td></tr>';

					$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Порт приписки', 'homeport__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][homeport]" id="homeport__'.$counter.'" value="'.$arResult['MAINTRANSPORT']['homeport'].'" size="70"></td></tr>';
					$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Назначение', 'func__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][func]" id="func__'.$counter.'" value="'.$arResult['MAINTRANSPORT']['func'].'" size="70"></td></tr>';
					$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Наибольшая длина', 'length__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][length]" id="length__'.$counter.'" value="'.$arResult['MAINTRANSPORT']['length'].'"></td></tr>';
					$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Наибольшая ширина', 'width__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][width]" id="width__'.$counter.'" value="'.$arResult['MAINTRANSPORT']['width'].'"></td></tr>';
					$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Наибольшая осадка', 'draught__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][draught]" id="draught__'.$counter.'" value="'.$arResult['MAINTRANSPORT']['draught'].'"></td></tr>';
					$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Мореходность', 'seaworth__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][seaworth]" id="seaworth__'.$counter.'" value="'.$arResult['MAINTRANSPORT']['seaworth'].'" size="70"></td></tr>';
					$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Полное водоизмещение (в тоннах)', 'displace__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][displace]" id="displace__'.$counter.'" value="'.$arResult['MAINTRANSPORT']['displace'].'"></td></tr>';
					$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Тип и мощность главной энергетической установки', 'generator__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][generator]" id="generator__'.$counter.'" value="'.$arResult['MAINTRANSPORT']['generator'].'" size="70"></td></tr>';
					$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Радиочастоты', 'rdfreq__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][rdfreq]" id="rdfreq__'.$counter.'" value="'.$arResult['MAINTRANSPORT']['rdfreq'].'" size="70"></td></tr>';
					$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Радиопозывные', 'rdsign__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][rdsign]" id="rdsign__'.$counter.'" value="'.$arResult['MAINTRANSPORT']['rdsign'].'" size="70"></td></tr>';
					$fields .= '<tr><td  CLASS="head">Экипаж:</td><td  CLASS="head">&nbsp;</td></tr>';
					$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Капитан', 'capt__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][capt]" id="capt__'.$counter.'" value="'.$arResult['MAINTRANSPORT']['capt'].'" size="70"></td></tr>';
					$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Команда', 'crew__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][crew]" id="crew__'.$counter.'" value="'.$arResult['MAINTRANSPORT']['crew'].'"></td></tr>';
					$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Экспедиционный состав', 'researchers__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][researchers]" id="researchers__'.$counter.'" value="'.$arResult['MAINTRANSPORT']['researchers'].'"></td></tr>';
					$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Руководитель морских научных исследований', 'head__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][head]" id="head__'.$counter.'" value="'.$arResult['MAINTRANSPORT']['head'].'" size="70"></td></tr>';
				break;

				case 'other':
					$fields = '';
					$counter = 1;
					$fields = '<tr class="trHighLighted"><td>'.requiredTitle('Название', 'transport_name__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][transport_name]" id="transport_name__'.$counter.'" size=100 value="'.$arResult['MAINTRANSPORT']['name'].'"></td></tr>';
					$fields .= '<tr><td  CLASS="head">Экипаж:</td><td  CLASS="head">&nbsp;</td></tr>';
					$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Капитан', 'capt__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][capt]" id="capt__'.$counter.'" value="'.$arResult['MAINTRANSPORT']['capt'].'" size="70"></td></tr>';
					$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Команда', 'crew__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][crew]" id="crew__'.$counter.'" value="'.$arResult['MAINTRANSPORT']['crew'].'"></td></tr>';
					$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Экспедиционный состав', 'researchers__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][researchers]" id="researchers__'.$counter.'" value="'.$arResult['MAINTRANSPORT']['researchers'].'"></td></tr>';
					$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Руководитель морских научных исследований', 'head__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][head]" id="head__'.$counter.'" value="'.$arResult['MAINTRANSPORT']['head'].'" size="70"></td></tr>';

				break;
			}

	$fields = '<div id="placerTransport1">Тип транспорта: <select name="TRANSPORT[1][type]" id="selTransport1" onchange="getTransportType(this, 1, \'transp1\')"><option value=0 /><option value="ship" '.($arResult['MAINTRANSPORT']['type'] == 'ship' ? ' selected ' : '').'>Судно<option value="other" '.($arResult['MAINTRANSPORT']['type'] == 'other' ? ' selected ' : '').'>Другое ТС</select></div>
	<input type="hidden" name="TRANSPORT['.$counter.'][eid]" value="'.$arResult['MAINTRANSPORT']['id'].'">
	<input type="hidden" name="TRANSPORT['.$counter.'][curType]" value="'.$arResult['MAINTRANSPORT']['type'].'">
	<input type="hidden" name="TRANSPORT['.$counter.'][main_trs]" value="1">
	<div id="transp1">
	<div id="descTransport1">
	<table CELLSPACING="0" CELLPADDING="0" CLASS="tab" STYLE="border: 1px solid #cdcdcd">'.$fields.'
			<script>$(document).ready( function(){
					$(\'#placer_mtrans_shipowner'.$counter.'_country\').append(getCountriesSelect(\'TRANSPORT['.$counter.'][shipowner_country]\', \'shipowner_country__'.$counter.'\', \''.$arResult['MAINTRANSPORT']['shipowner_country'].'\', \'\') );
					$(\'#placer_mtrans_nation'.$counter.'\').append(getCountriesSelect(\'TRANSPORT['.$counter.'][nation]\', \'nation__'.$counter.'\', \''.$arResult['MAINTRANSPORT']['nation'].'\', \'\') );
				});
			</script>
	</table>
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
	$(document).ready(function(){
	// --- Автозаполнение ---

	$(\"#homeport__{$counter}\").autocomplete(\"/ajax.php\", {
		delay:10,
		minChars:2,
		matchSubset:1,
		autoFill:false,
		matchContains:1,
		cacheLength:10,
		selectFirst:true,
		formatItem:liFormat,
		maxItemsToShow:10,
		onItemSelect:selectItemTransportPort,
		action:'getPortsList',
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

						$fields = '<tr class="trHighLighted"><td>'.requiredTitle('Название', 'shipname__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][shipname]" id="shipname__'.$counter.'" size=100 value="'.$arItem['name'].'"></td></tr>';
						$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Национальность', 'nation__'.$counter).':</td>
													<td id="placer_trans_nation'.$counter.'">
													</td></tr>';
						$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Судовладелец', 'shipowner__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][shipowner]" id="shipowner__'.$counter.'" value="'.$arItem['shipowner'].'" size="80"></td></tr>';

						$fields .= '<tr class="trHighLighted"><td class=\'shiftLeft20\'>'.requiredTitle('Государство', 'shipowner_country__'.$counter).':</td>
						<td id="placer_trans_shipowner'.$counter.'_country">
						</td></tr>';
						$fields .= '<tr class="trHighLighted"><td class=\'shiftLeft20\'>'.requiredTitle('Город', 'shipowner_city__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][shipowner_city]" id="shipowner_city__'.$counter.'" value="'.$arItem['shipowner_city'].'"></td></tr>';
						$fields .= '<tr class="trHighLighted"><td class=\'shiftLeft20\'>'.requiredTitle('Юридический адрес', 'shipowner_legaladdress__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][shipowner_legaladdress]" id="shipowner_legaladdress__'.$counter.'" value="'.$arItem['shipowner_legaladdress'].'"></td></tr>';
						$fields .= '<tr class="trHighLighted"><td class=\'shiftLeft20\'>'.requiredTitle('Телефон', 'shipowner_phone__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][shipowner_phone]" id="shipowner_phone__'.$counter.'" value="'.$arItem['shipowner_phone'].'"></td></tr>';
						$fields .= '<tr class="trHighLighted"><td class=\'shiftLeft20\'>Телефакс:</td><td><input type="text" name="TRANSPORT['.$counter.'][shipowner_fax]" id="shipowner_fax__'.$counter.'" value="'.$arItem['shipowner_fax'].'"></td></tr>';
						$fields .= '<tr class="trHighLighted"><td class=\'shiftLeft20\'>Телекс:</td><td><input type="text" name="TRANSPORT['.$counter.'][shipowner_telex]" id="shipowner_telex__'.$counter.'" value="'.$arItem['shipowner_telex'].'"></td></tr>';
						$fields .= '<tr class="trHighLighted"><td class=\'shiftLeft20\'>'.requiredTitle('E-mail', 'shipowner_email__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][shipowner_email]" id="shipowner_email__'.$counter.'" value="'.$arItem['shipowner_email'].'"></td></tr>';

						$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Порт приписки', 'homeport__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][homeport]" id="homeport__'.$counter.'" value="'.$arItem['homeport'].'" size="70"></td></tr>';
						$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Назначение', 'func__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][func]" id="func__'.$counter.'" value="'.$arItem['func'].'" size="70"></td></tr>';
						$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Наибольшая длина', 'length__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][length]" id="length__'.$counter.'" value="'.$arItem['length'].'"></td></tr>';
						$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Наибольшая ширина', 'width__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][width]" id="width__'.$counter.'" value="'.$arItem['width'].'"></td></tr>';
						$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Наибольшая осадка', 'draught__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][draught]" id="draught__'.$counter.'" value="'.$arItem['draught'].'"></td></tr>';
						$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Мореходность', 'seaworth__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][seaworth]" id="seaworth__'.$counter.'" value="'.$arItem['seaworth'].'" size="70"></td></tr>';
						$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Полное водоизмещение', 'displace__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][displace]" id="displace__'.$counter.'" value="'.$arItem['displace'].'"></td></tr>';
						$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Тип и мощность главной энергетической установки', 'generator__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][generator]" id="generator__'.$counter.'" value="'.$arItem['generator'].'" size="70"></td></tr>';
						$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Радиочастоты', 'rdfreq__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][rdfreq]" id="rdfreq__'.$counter.'" value="'.$arItem['rdfreq'].'" size="70"></td></tr>';
						$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Радиопозывные', 'rdsign__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][rdsign]" id="rdsign__'.$counter.'" value="'.$arItem['rdsign'].'" size="70"></td></tr>';
						$fields .= '<tr><td  CLASS="head">Экипаж:</td><td  CLASS="head">&nbsp;</td></tr>';
						$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Капитан', 'capt__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][capt]" id="capt__'.$counter.'" value="'.$arItem['capt'].'" size="70"></td></tr>';
						$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Команда', 'crew__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][crew]" id="crew__'.$counter.'" value="'.$arItem['crew'].'"></td></tr>';
						$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Экспедиционный состав', 'researchers__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][researchers]" id="researchers__'.$counter.'" value="'.$arItem['researchers'].'"></td></tr>';
						$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Руководитель морских научных исследований', 'head__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][head]" id="head__'.$counter.'" value="'.$arItem['head'].'" size="70"></td></tr>';

					break;
					case 'other':
							$fields = '<tr class="trHighLighted"><td>'.requiredTitle('Название', 'transport_name__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][transport_name]" id="transport_name__'.$counter.'" size=100 value="'.prepareString($arItem['name']).'"></td></tr>';
							$fields .= '<tr><td  CLASS="head">Экипаж:</td><td  CLASS="head">&nbsp;</td></tr>';
							$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Капитан', 'capt__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][capt]" id="capt__'.$counter.'" value="'.$arItem['capt'].'" size="70"></td></tr>';
							$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Команда', 'crew__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][crew]" id="crew__'.$counter.'" value="'.$arItem['crew'].'"></td></tr>';
							$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Экспедиционный состав', 'researchers__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][researchers]" id="researchers__'.$counter.'" value="'.$arItem['researchers'].'"></td></tr>';
							$fields .= '<tr class="trHighLighted"><td>'.requiredTitle('Руководитель морских научных исследований', 'head__'.$counter).':</td><td><input type="text" name="TRANSPORT['.$counter.'][head]" id="head__'.$counter.'" value="'.$arItem['head'].'" size="70"></td></tr>';

					break;

				}
			$fields = '
			<p>
				<div id="placerTransport'.$counter.'">Тип транспорта:
					<select name="TRANSPORT['.$counter.'][type]" id="selTransport'.$counter.'" onchange="getTransportType(this, '.$counter.', \'transp2\')">
						<option value=0 />
							<option value="ship" '.($arItem['type'] == 'ship' ? ' selected ' : '').'>Судно
							<option value="other" '.($arItem['type'] == 'other' ? ' selected ' : '').'>Другое ТС
						</select>
						<input type="button" id="delTransport'.$counter.'" onclick=" if(confirmDeleteRecord()) deleteBlockTransportComplete('.$arItem['id'].', \''.$arItem['type'].'\', '.$counter.')" value="Удалить">
				</div>
			</p>

			<div id="descTransport'.$counter.'">
				<input type="hidden" name="TRANSPORT['.$counter.'][eid]" value="'.$arItem['id'].'">
				<input type="hidden" name="TRANSPORT['.$counter.'][curType]" value="'.$arItem['type'].'">
				<input type="hidden" name="TRANSPORT['.$counter.'][main_trs]" value="0">
	<TABLE CELLSPACING="0" CELLPADDING="0" CLASS="tab" STYLE="border: 1px solid #cdcdcd">'.$fields.'
			<script>$(document).ready( function(){
					$(\'#placer_trans_shipowner'.$counter.'_country\').append(getCountriesSelect(\'TRANSPORT['.$counter.'][shipowner_country]\', \'shipowner_country__'.$counter.'\', \''.$arItem['shipowner_country'].'\', \'\') );
					$(\'#placer_trans_nation'.$counter.'\').append(getCountriesSelect(\'TRANSPORT['.$counter.'][nation]\', \'nation__'.$counter.'\', \''.$arItem['nation'].'\', \'\') );
				});
			</script>

	</table>
<script>

	$(document).ready(function(){
	// --- Автозаполнение название организации владельца---
	$("#shipowner__'.$counter.'").autocomplete("/ajax_particip.php", {
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
		action:\'getParticipName\',
		Counter: "'.$counter.'"
			});
	});

	$(document).ready(function(){
	// --- Автозаполнение информация о судне---
	$("#shipname__'.$counter.'").autocomplete("/ajax.php", {
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
		action:\'getShipInfo\',
		Counter: "'.$counter.'"
			});
	});


	$(document).ready(function(){
	// --- Автозаполнение порт приписки---
	$("#homeport__'.$counter.'").autocomplete("/ajax.php", {
		delay:10,
		minChars:2,
		matchSubset:1,
		autoFill:false,
		matchContains:1,
		cacheLength:10,
		selectFirst:true,
		formatItem:liFormat,
		maxItemsToShow:10,
		onItemSelect: selectItemTransportPort,
		action: "getPortsList",
		Counter: "'.$counter.'"
			});
	});
</script>
	</div>';

			echo $fields;
			}
			echo '	</div>';
			?>
<? 	}else{ ?>
	<div id="transp2" style="border 1px solid #000">&nbsp;</div>
<?	} ?>

		<input type="button" onclick="newTransportBlock('transp2')" value="Добавить транспорт">
