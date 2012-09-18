<p class="subtitle">6. Маршрут движения судна от точки пересечения границы Российской Федерации до района морских научных исследований и обратно (для иностранных судов)</p>
 <table id="tableshiproot" class="tab">
 <tbody>
 <tr>
 	<td class="head">№ точки</td>
 	<td class="head">Дата прохождения<br />(YYYY-MM-DD)</td>
 	<td class="head">Географическая широта<br />(в градусах, минутах и долях минут)</td>
 	<td class="head">Географическая долгота<br />(в градусах, минутах и долях минут)</td>
 	<td class="head">&nbsp</td>
 </tr>
		<?
		$scripts = '';
		$fields = '';
		$minDate = $arResult['EXPEDITION']['date_start'];
		$coordType = 'shiproot';
		if( count($arResult['COORDS'][$coordType]) > 0 ){
			foreach ($arResult['COORDS'][$coordType] as $key=>$arItem){
				$counter = $key + 1;
				list($latGrad, $latMin) = explode(';', $arItem['latitiude']);
				list($langGrad, $langMin, $langType) = explode(';', $arItem['langitude']);
				$fields = '<tr id="tr'.$counter.'">';
				$fields .= '<td>'.$counter.'</td>';
				$fields .= '<td><input type="hidden" name="COORDS['.$coordType.']['.$counter.'][num]" id="'.$coordType.'_num" value="'.$arItem['num'].'">';
				$fields .= '<input type="text" name="COORDS['.$coordType.']['.$counter.'][landing_date]" id="'.$coordType.$counter.'landing_date" onchange="dpFormatValue(this)" value="'.$arItem['landing_date'].'">';
				$fields .= '</td>';

				$fields .= '<td>';
				$fields .= '<input type="text" size="1" name="COORDS['.$coordType.']['.$counter.'][lat_grad]" id="'.$coordType.$counter.'lat_grad" onkeyup="checkCoord(\''.$coordType.$counter.'lat_grad\', \''.$coordType.$counter.'lat_min\')"  maxlength="3" value="'.$latGrad.'">&#176&nbsp;&nbsp;&nbsp;';

				$fields .= '<input type="text" size="3" name="COORDS['.$coordType.']['.$counter.'][lat_min]" id="'.$coordType.$counter.'lat_min" onkeyup="checkCoord(\''.$coordType.$counter.'lat_min\', \'\')"  maxlength="6" value="'.$latMin.'">&#39 с.ш.';
				$fields .= '</td>';

				$fields .= '<td>';
				$fields .= '<input type="text" size="1" name="COORDS['.$coordType.']['.$counter.'][lang_grad]" id="'.$coordType.$counter.'lang_grad" onkeyup="checkCoord(\''.$coordType.$counter.'lang_grad\', \''.$coordType.$counter.'lang_min\')"  maxlength="3" value="'.$langGrad.'">&#176&nbsp;&nbsp;&nbsp;';
				$fields .= '<input type="text" size="3" name="COORDS['.$coordType.']['.$counter.'][lang_min]" id="'.$coordType.$counter.'lang_min" onkeyup="checkCoord(\''.$coordType.$counter.'lang_min\', \'\')"  maxlength="6" value="'.$langMin.'">&#39';
				$fields .= '<input type="radio" name="COORDS['.$coordType.']['.$counter.'][lang_type]" value="в.д." '.($langType == 'в.д.' ? ' checked ':'').'>в.д.';
				$fields .= '<input type="radio" name="COORDS['.$coordType.']['.$counter.'][lang_type]" value="з.д." '.($langType == 'з.д.' ? ' checked ':'').'>з.д.';
				$fields .= '</td>';

				$fields .= '<td>';
				$fields .= '<input type="button" onclick=" if(confirmDelete()) deleteTrComplete('.$counter.', \''.$coordType.'\', '.$arItem['id'].')" value="Удалить">';
				$fields .= '</td>';

				$fields .= '</tr>';

				echo $fields;


				$scripts .= "$('#{$coordType}{$counter}landing_date').datepick({ minDate: '{$minDate}', maxDate: cMaxDate, showTrigger: '#calImg'});";
				$minDate = $arItem['landing_date'];

				//
			}
		}
		$commentField = '<p style="vertical-align: top">Дополнительная информация: <textarea name="TABLES_COMMENT['.$coordType.'][comment]" id="'.$coordType.$counter.'comment" style="width: 500px; height: 22px">'.$arResult['TABLES_COMMENT'][$coordType].'</textarea></p>';
		$scripts .= "setTextareaResizeNew('{$coordType}{$counter}comment', 500, 22, 500, newHeight);";
		?>
 </tbody>
 </table>
<input type="button" onclick="addCoordsBlock('shiproot')" value="Добавить запись">
<? if(!empty($commentField) ) { echo $commentField;} $commentField = '';?>
 <?php echo (!empty($scripts) ? "<script> $(function(){ {$scripts} });</script>" : '');
 $scripts = "";?>
<br>
<p class="subtitle">7. Названия портов Российской Федерации, дата, (YYYY-MM-DD) и цель их посещения (для иностранных судов)</p>
 <table id="tableports" class="tab">
 <tbody>
 <tr>
 	<td class="head">№</td>
 	<td class="head">Дата прохождения<br />(YYYY-MM-DD)</td>
 	<td class="head">Название порта РФ</td>
 	<td class="head">Цель посещения (для иностранных судов)</td>
 	<td class="head">&nbsp</td>
 </tr>
		<?
		$scripts = '';
		$fields = '';
		$coordType = 'ports';
		$minDate = $arResult['EXPEDITION']['date_start'];
		if( count($arResult['PORTS']['ports']) > 0 ){
			foreach ($arResult['PORTS']['ports'] as $key=>$arItem){
				$counter = $key + 1;
				$fields = '<tr id="tr'.$counter.'">';
				$fields .= '<td>'.$counter.'</td>';
				$fields .= '<td><input type="hidden" name="PORTS['.$coordType.']['.$counter.'][num]" id="'.$coordType.$counter.'_num" value="'.$arItem['num'].'">';
				$fields .= '<input type="text" name="PORTS['.$coordType.']['.$counter.'][landing_date]" id="'.$coordType.$counter.'landing_date" onchange="dpFormatValue(this)" value="'.$arItem['landing_date'].'">';
				$fields .= '</td>';

				$fields .= '<td>';
					$fields .= '<input type="text" name="PORTS['.$coordType.']['.$counter.'][port]" id="'.$coordType.$counter.'port" value="'.$arItem['port'].'">';
				$fields .= '</td>';

				$fields .= '<td>';
				$fields .= '<textarea name="PORTS['.$coordType.']['.$counter.'][comment]" id="'.$coordType.$counter.'comment" rows="1">'.$arItem['comment'].'</textarea>';
				$fields .= '</td>';

				$fields .= '<td>';
				$fields .= '<input type="button" onclick=" if(confirmDelete()) deleteTrPortComplete('.$counter.', \''.$coordType.'\', '.$arItem['id'].')" value="Удалить">';
				$fields .= '</td>';

				$fields .= '</tr>';

				echo $fields;

				$scripts .= "
				$('#{$coordType}{$counter}landing_date').datepick({ minDate: '{$minDate}', maxDate: cMaxDate, showTrigger: '#calImg'});
				setTextareaResizeNew('{$coordType}{$counter}comment', 185, txtHeight, txtWidth, newHeight);
	$(document).ready(function(){
	// --- Автозаполнение Порт---

			$(\"#{$coordType}{$counter}port\").autocomplete(\"/ajax.php\", {
				delay:10,
				minChars:2,
				matchSubset:1,
				autoFill:false,
				matchContains:1,
				cacheLength:10,
				selectFirst:true,
				formatItem:liFormat,
				maxItemsToShow:10,
				onItemSelect:selectItemPort,
				action:'getPortsList',
				Counter:'{$counter}'
			});
	});

				";
				$minDate = $arItem['landing_date'];

			}
		}
		$commentField = '<p style="vertical-align: top">Дополнительная информация: <textarea name="TABLES_COMMENT['.$coordType.'][comment]" id="'.$coordType.$counter.'comment" style="width: 500px; height: 22px">'.$arResult['TABLES_COMMENT'][$coordType].'</textarea></p>';
		$scripts .= "setTextareaResizeNew('{$coordType}{$counter}comment', 500, 22, 500, newHeight);";

		?>
 </tbody>
 </table>
<input type="button" onclick="addPortsBlock('ports')" value="Добавить запись">
<? if(!empty($commentField) ) { echo $commentField;} $commentField = '';?>
 <?php echo (!empty($scripts) ? "<script>$(function(){ {$scripts} });</script>" : '');
			$scripts = "";?>
<br>

<p class="subtitle">8. <?=requiredTitle('Дата первого прибытия в район морских научных исследований (YYYY-MM-DD)', 'date_start')?>

<input type="text" name="EXPEDITION[date_start]" id="date_start" size="10" value="<?=($arResult['EXPEDITION']['date_start'] != '0000-00-00' ? $arResult['EXPEDITION']['date_start'] : null)?>">
<br>&nbsp;&nbsp;&nbsp;
<?=requiredTitle('Дата окончательного ухода  из района морских научных исследований (YYYY-MM-DD)', 'date_end')?> <input type="text" name="EXPEDITION[date_end]" id="date_end" value="<?=($arResult['EXPEDITION']['date_end'] != '0000-00-00' ? $arResult['EXPEDITION']['date_end'] : null)?>" size="10" onchange="changeDeadlinePrevReport(this)"> </p>
<br>
<p class="subtitle">9. <?=requiredTitle('Координаты района морских научных исследований', 'tablemniregion')?></p>
 <table id="tablemniregion" class="tab">
 <tbody>
 <tr>
 	<td class="head">№ точки</td>
<!-- 	<td class="head">Дата прохождения<br />(YYYY-MM-DD)</td>-->
 	<td class="head">Географическая широта<br />(в градусах, минутах и долях минут) <?=requiredMark()?></td>
 	<td class="head">Географическая долгота<br />(в градусах, минутах и долях минут)<?=requiredMark()?></td>
 	<td class="head">&nbsp</td>
 </tr>
		<?
		$scripts = '';
		$coordType = 'mniregion';
		if( count($arResult['COORDS']['mniregion']) > 0 ){
			$minDate = $arResult['EXPEDITION']['date_start'];
			foreach ($arResult['COORDS']['mniregion'] as $key=>$arItem){
				$counter = $key + 1;
				list($latGrad, $latMin) = explode(';', $arItem['latitiude']);
				list($langGrad, $langMin, $langType) = explode(';', $arItem['langitude']);
				$fields = '<tr id="tr'.$counter.'">';
				$fields .= '<td>'.$counter.'<input type="hidden" name="COORDS['.$coordType.']['.$counter.'][num]" id="'.$coordType.'_num" value="'.$arItem['num'].'"></td>';
//				$fields .= '<td>';
//				$fields .= '<input type="text" name="COORDS['.$coordType.']['.$counter.'][landing_date]" id="'.$coordType.$counter.'landing_date" onchange="dpFormatValue(this)" value="'.$arItem['landing_date'].'">';
//				$fields .= '</td>';

				$fields .= '<td>';
				$fields .= '<input type="text" size="1" name="COORDS['.$coordType.']['.$counter.'][lat_grad]" id="'.$coordType.$counter.'lat_grad" onkeyup="checkCoord(\''.$coordType.$counter.'lat_grad\', \''.$coordType.$counter.'lat_min\')"  maxlength="3" value="'.$latGrad.'">&#176&nbsp;&nbsp;&nbsp;';

				$fields .= '<input type="text" size="3" name="COORDS['.$coordType.']['.$counter.'][lat_min]" id="'.$coordType.$counter.'lat_min" onkeyup="checkCoord(\''.$coordType.$counter.'lat_min\', \'\')"  maxlength="6" value="'.$latMin.'">&#39 с.ш.';
				$fields .= '</td>';

				$fields .= '<td>';
				$fields .= '<input type="text" size="1" name="COORDS['.$coordType.']['.$counter.'][lang_grad]" id="'.$coordType.$counter.'lang_grad" onkeyup="checkCoord(\''.$coordType.$counter.'lang_grad\', \''.$coordType.$counter.'lang_min\')"  maxlength="3" value="'.$langGrad.'">&#176&nbsp;&nbsp;&nbsp;';
				$fields .= '<input type="text" size="3" name="COORDS['.$coordType.']['.$counter.'][lang_min]" id="'.$coordType.$counter.'lang_min" onkeyup="checkCoord(\''.$coordType.$counter.'lang_min\', \'\')"  maxlength="6" value="'.$langMin.'">&#39';
				$fields .= '<input type="radio" name="COORDS['.$coordType.']['.$counter.'][lang_type]" value="в.д." '.($langType == 'в.д.' ? ' checked ':'').'>в.д.';
				$fields .= '<input type="radio" name="COORDS['.$coordType.']['.$counter.'][lang_type]" value="з.д." '.($langType == 'з.д.' ? ' checked ':'').'>з.д.';
				$fields .= '</td>';

				$fields .= '<td>';
				$fields .= '<input type="button" onclick=" if(confirmDelete()) deleteTrComplete('.$counter.', \''.$coordType.'\', '.$arItem['id'].')" value="Удалить">';
				$fields .= '</td>';

				$fields .= '</tr>';

				$scripts .= "$('#{$coordType}{$counter}landing_date').datepick({ minDate: '{$minDate}', maxDate: cMaxDate, showTrigger: '#calImg'});";
				$minDate = $arItem['landing_date'];
				echo $fields;
			}
		}
		$commentField = '<p style="vertical-align: top">Дополнительная информация: <textarea name="TABLES_COMMENT['.$coordType.'][comment]" id="'.$coordType.$counter.'comment" style="width: 500px; height: 22px">'.$arResult['TABLES_COMMENT'][$coordType].'</textarea></p>';
		$scripts .= "setTextareaResizeNew('{$coordType}{$counter}comment', 500, 22, 500, newHeight);";
		?>
 </tbody>
 </table>
<input type="button" onclick="addMniregionBlock('mniregion')" value="Добавить запись">
<? if(!empty($commentField) ) { echo $commentField;} $commentField = '';?>
 <?php echo (!empty($scripts) ? "<script>$(function(){ {$scripts} });</script>" : '');
			$scripts = "";?>
<br>
<p class="subtitle">&nbsp;&nbsp;&nbsp;&nbsp;<?=requiredTitle('Маршрут движения судна в районе морских научных исследований (если исследования осуществляются по маршруту)', 'tablemniroot')?> </p>
 <table id="tablemniroot" class="tab">
 <tbody>
 <tr>
 	<td class="head">№ точки</td>
 	<td class="head">Дата прохождения<br />(YYYY-MM-DD) <?=requiredMark()?></td>
 	<td class="head">Географическая широта<br />(в градусах, минутах и долях минут) <?=requiredMark()?></td>
 	<td class="head">Географическая долгота<br />(в градусах, минутах и долях минут) <?=requiredMark()?></td>
 	<td class="head">Примечания</td>
 	<td class="head">&nbsp</td>
 </tr>
		<?
			$scripts = '';
			$coordType = 'mniroot';
			if( count($arResult['COORDS']['mniroot']) > 0 ){
			$minDate = $arResult['EXPEDITION']['date_start'];
			foreach ($arResult['COORDS']['mniroot'] as $key=>$arItem){
				$counter = $key + 1;
				list($latGrad, $latMin) = explode(';', $arItem['latitiude']);
				list($langGrad, $langMin, $langType) = explode(';', $arItem['langitude']);
				$fields = '<tr id="tr'.$counter.'">';
				$fields .= '<td>'.$counter.'</td>';
				$fields .= '<td><input type="hidden" name="COORDS['.$coordType.']['.$counter.'][num]" id="'.$coordType.'_num" value="'.$arItem['num'].'">';
				$fields .= '<input type="text" name="COORDS['.$coordType.']['.$counter.'][landing_date]" id="'.$coordType.$counter.'landing_date" onchange="dpFormatValue(this)" value="'.$arItem['landing_date'].'">';
				$fields .= '</td>';

				$fields .= '<td>';
				$fields .= '<input type="text" size="1" name="COORDS['.$coordType.']['.$counter.'][lat_grad]" id="'.$coordType.$counter.'lat_grad" onkeyup="checkCoord(\''.$coordType.$counter.'lat_grad\', \''.$coordType.$counter.'lat_min\')"  maxlength="3" value="'.$latGrad.'">&#176&nbsp;&nbsp;&nbsp;';

				$fields .= '<input type="text" size="3" name="COORDS['.$coordType.']['.$counter.'][lat_min]" id="'.$coordType.$counter.'lat_min" onkeyup="checkCoord(\''.$coordType.$counter.'lat_min\', \'\')"  maxlength="6" value="'.$latMin.'">&#39 с.ш.';
				$fields .= '</td>';

				$fields .= '<td>';
				$fields .= '<input type="text" size="1" name="COORDS['.$coordType.']['.$counter.'][lang_grad]" id="'.$coordType.$counter.'lang_grad" onkeyup="checkCoord(\''.$coordType.$counter.'lang_grad\', \''.$coordType.$counter.'lang_min\')"  maxlength="3" value="'.$langGrad.'">&#176&nbsp;&nbsp;&nbsp;';
				$fields .= '<input type="text" size="3" name="COORDS['.$coordType.']['.$counter.'][lang_min]" id="'.$coordType.$counter.'lang_min" onkeyup="checkCoord(\''.$coordType.$counter.'lang_min\', \'\')"  maxlength="6" value="'.$langMin.'">&#39';
				$fields .= '<input type="radio" name="COORDS['.$coordType.']['.$counter.'][lang_type]" value="в.д." '.($langType == 'в.д.' ? ' checked ':'').'>в.д.';
				$fields .= '<input type="radio" name="COORDS['.$coordType.']['.$counter.'][lang_type]" value="з.д." '.($langType == 'з.д.' ? ' checked ':'').'>з.д.';
				$fields .= '</td>';
				$fields .= '<td><textarea name="COORDS['.$coordType.']['.$counter.'][info]" id="'.$coordType.$counter.'info" style="width: 185px; height: 22px">'.$arItem['info'].'</textarea></td>';
				$fields .= '<td>';
				$fields .= '<input type="button" onclick=" if(confirmDelete()) deleteTrComplete('.$counter.', \''.$coordType.'\', '.$arItem['id'].')" value="Удалить">';
				$fields .= '</td>';

				$fields .= '</tr>';

				$scripts .= "$('#{$coordType}{$counter}landing_date').datepick({ minDate: '{$minDate}', maxDate: cMaxDate, showTrigger: '#calImg'});\n setTextareaResizeNew('{$coordType}{$counter}info', 185, 22, 300, newHeight);
				";
				$minDate = $arItem['landing_date'];
				echo $fields;
			}
		}
		$commentField = '<p style="vertical-align: top">Дополнительная информация: <textarea name="TABLES_COMMENT['.$coordType.'][comment]" id="'.$coordType.$counter.'comment" style="width: 500px; height: 22px">'.$arResult['TABLES_COMMENT'][$coordType].'</textarea></p>';
		$scripts .= "setTextareaResizeNew('{$coordType}{$counter}comment', 500, 22, 500, newHeight);";
		?>
 </tbody>
 </table>
 <input type="button" onclick="addMnirootBlock('mniroot')" value="Добавить запись">
<? if(!empty($commentField) ) { echo $commentField;} $commentField = '';?>
 <?php echo (!empty($scripts) ? "<script>$(function(){ {$scripts} });</script>" : '');
			$scripts = "";?>
<br>