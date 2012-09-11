<p class="subtitle">10. Программа морских научных исследований </p>
<div class="shiftLeft20">
<table class="tab" style="border: 0px" cellpadding="0" cellspacing="0">
	<tr>
		<td>а) <?=requiredTitle('Название', 'mni_name')?> </td><td><textarea name="EXPEDITION[mni_name]" id="mni_name" ><?=$arResult['EXPEDITION']['mni_name']?></textarea></td>
	</tr>
	<tr>
		<td>б) <?=requiredTitle('Цель', 'mni_aim')?> </td><td><textarea name="EXPEDITION[mni_aim]" id="mni_aim" ><?=$arResult['EXPEDITION']['mni_aim']?></textarea></td>
	</tr>
	<tr>
		<td colspan="2"><p>в) <?=requiredTitle('Виды морских научных исследований (работ), методы и последовательность их выполнения', 'tablemnitypes')?></p>
		 <table id="tablemnitypes" class="tab">
		 <tbody>
		 <tr>
		 	<td class="head">№</td>
		 	<td class="head">Тип наблюдений</td>
		 	<td class="head">Вид наблюдений</td>
		 	<td class="head">Структурная единица</td>
		 	<td class="head">Количество</td>
		 	<td class="head">&nbsp</td>
		 </tr>
				<?
				$scripts = '';
				$coordType = 'meteo';
				if( count($arResult['MNITYPE']['meteo']) > 0 ){
					foreach ($arResult['MNITYPE']['meteo'] as $key=>$arItem){
						$counter = $key + 1;
						?>
						<script>
						$(document).ready(function(){
							addMNITypeBlock('mnitypes');
							$('#mnitypes'+(counterMNITypeBlock-1)+'_mnitype').val('<?=$arItem['mnitype']?>');
							generateMNISort('mnitypes', (counterMNITypeBlock-1), 'mnitypes'+(counterMNITypeBlock-1)+'_mnitype', 'placermnitypes'+(counterMNITypeBlock-1));
							$('#mnitypes'+(counterMNITypeBlock-1)+'_mnisort').val('<?=$arItem['mnisort']?>');
							$('#mnitypes'+(counterMNITypeBlock-1)+'_mniunit').val('<?=$arItem['mniunit']?>');
							$('#mnitypes'+(counterMNITypeBlock-1)+'_amount').val('<?=$arItem['amount']?>');
						});
						</script>
						<?
//						$fields = '<tr id="tr'.$counter.'">';
//						$fields .= '<td>'.$counter.'</td>';
//						$fields .= '<td><input type="hidden" name="MNITYPE['.$coordType.']['.$counter.'][num]" id="'.$coordType.'_num" value="'.$arItem['num'].'">';
//						$fields .= '<input type="text" name="MNITYPE['.$coordType.']['.$counter.'][landing_date]" value="'.$arItem['landing_date'].'">';
//						$fields .= '</td>';
//
//						$fields .= '<td>';
//							$fields .= '<input type="text" name="MNITYPE['.$coordType.']['.$counter.'][port]" id="'.$coordType.$counter.'port" value="'.$arItem['port'].'">';
//						$fields .= '</td>';
//
//						$fields .= '<td>';
//						$fields .= '<textarea name="MNITYPE['.$coordType.']['.$counter.'][comment]" id="'.$coordType.$counter.'comment">'.$arItem['comment'].'</textarea>';
//						$fields .= '</td>';
//
//						$fields .= '<td>';
//						$fields .= '<input type="button" onclick="deleteTrPortComplete('.$counter.', \''.$coordType.'\', '.$arItem['id'].')" value="Удалить">';
//						$fields .= '</td>';
//
//						$fields .= '</tr>';
//
//						echo $fields;
					}
				}
				$commentField = '<p style="vertical-align: top">Дополнительная информация: <textarea name="TABLES_COMMENT['.$coordType.'][comment]" id="'.$coordType.$counter.'comment" style="width: 500px; height: 22px">'.$arResult['TABLES_COMMENT'][$coordType].'</textarea></p>';
				$scripts .= "setTextareaResizeNew('{$coordType}{$counter}comment', 500, 22, 500, newHeight);";
				?>
		 </tbody>
		 </table>
		<input type="button" onclick="addMNITypeBlock('mnitypes')" value="Добавить запись">
<? if(!empty($commentField) ) { echo $commentField;} $commentField = '';?>
 <?php echo (!empty($scripts) ? "<script>$(function(){ {$scripts} });</script>" : '');
			$scripts = "";?>
		<br>
		</td>
	</tr>
	<tr>
		<td colspan="2"><p>г) Формы использования берегововй информаструктуры Российской Федерации, географические координаты (в градусах, минутах и долях минут)<br>
 мест предполагаемых высадок на побережье Российской Федерации</p>
	 <table id="tablemnishore" class="tab">
	 <tbody>
	 <tr>
	 	<td class="head">№ точки</td>
	 	<td class="head">Название места</td>
	 	<td class="head">Географическая широта<br />(в градусах, минутах и долях минут)</td>
	 	<td class="head">Географическая долгота<br />(в градусах, минутах и долях минут)</td>
	 	<td class="head">&nbsp</td>
	 </tr>
			<?
			$scripts = '';
			$coordType = 'mnishore';
			if( count($arResult['COORDS']['mnishore']) > 0 ){
				foreach ($arResult['COORDS']['mnishore'] as $key=>$arItem){
					$counter = $key + 1;
					list($latGrad, $latMin) = explode(';', $arItem['latitiude']);
					list($langGrad, $langMin, $langType) = explode(';', $arItem['langitude']);
					$fields = '<tr id="tr'.$counter.'">';
					$fields .= '<td>'.$counter.'<input type="hidden" name="COORDS['.$coordType.']['.$counter.'][num]" id="'.$coordType.'_num" value="'.$arItem['num'].'"></td>';
					$fields .= '<td><input type="text" name="COORDS['.$coordType.']['.$counter.'][info]" id="'.$coordType.$counter.'info" value="'.$arItem['info'].'"></td>';
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

//				$scripts .= "setTextareaResizeNew('{$coordType}{$counter}info', 185, 22, 185, newHeight);";
//					$scripts .= "$('#{$coordType}{$counter}landing_date').datepick({ minDate: cMinDate, maxDate: cMaxDate, showTrigger: '#calImg'});";
				}
			}
		$commentField = '<p style="vertical-align: top">Дополнительная информация: <textarea name="TABLES_COMMENT['.$coordType.'][comment]" id="'.$coordType.$counter.'comment" style="width: 500px; height: 22px">'.$arResult['TABLES_COMMENT'][$coordType].'</textarea></p>';
		$scripts .= "setTextareaResizeNew('{$coordType}{$counter}comment', 500, 22, 500, newHeight);";

			?>
	 </tbody>
	 </table>
	<input type="button" onclick="addMnishoreBlock('mnishore')" value="Добавить запись">
<? if(!empty($commentField) ) { echo $commentField;} $commentField = '';?>
 <?php echo (!empty($scripts) ? "<script>$(function(){ {$scripts} });</script>" : '');
			$scripts = "";?>
		<br>
		</td>
	</tr>
	<tr>
		<td colspan="2"><p>д) географические координаты (в градусах, минутах и долях минут) мест предполагаемых высадок на лед</p>
	 <table id="tablemniice" class="tab">
	 <tbody>
	 <tr>
	 	<td class="head">№ точки</td>
	 	<td class="head">Вид работ на льду</td>
	 	<td class="head">Географическая широта<br />(в градусах, минутах и долях минут)</td>
	 	<td class="head">Географическая долгота<br />(в градусах, минутах и долях минут)</td>
	 	<td class="head">&nbsp</td>
	 </tr>
			<?
			$scripts = '';
			$coordType = 'mniice';
			if( count($arResult['COORDS']['mniice']) > 0 ){
				foreach ($arResult['COORDS']['mniice'] as $key=>$arItem){
					$counter = $key + 1;
					list($latGrad, $latMin) = explode(';', $arItem['latitiude']);
					list($langGrad, $langMin, $langType) = explode(';', $arItem['langitude']);
					$fields = '<tr id="tr'.$counter.'">';
					$fields .= '<td>'.$counter.'<input type="hidden" name="COORDS['.$coordType.']['.$counter.'][num]" id="'.$coordType.'_num" value="'.$arItem['num'].'"></td>';

					$fields .= '<td><textarea name="COORDS['.$coordType.']['.$counter.'][info]" id="'.$coordType.$counter.'info" style="width: 185px; height: 22px">'.$arItem['info'].'</textarea></td>';
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

					$scripts .= "setTextareaResizeNew('{$coordType}{$counter}info', 185, 22, 300, newHeight);";
//					$scripts .= "$('#{$coordType}{$counter}landing_date').datepick({ minDate: cMinDate, maxDate: cMaxDate, showTrigger: '#calImg'});";

				}
			}
		$commentField = '<p style="vertical-align: top">Дополнительная информация: <textarea name="TABLES_COMMENT['.$coordType.'][comment]" id="'.$coordType.$counter.'comment" style="width: 500px; height: 22px">'.$arResult['TABLES_COMMENT'][$coordType].'</textarea></p>';
		$scripts .= "setTextareaResizeNew('{$coordType}{$counter}comment', 500, 22, 500, newHeight);";
			?>

	 </tbody>
	 </table>
	<input type="button" onclick="addMnishoreBlock('mniice')" value="Добавить запись">
<? if(!empty($commentField) ) { echo $commentField;} $commentField = '';?>
 <?php echo (!empty($scripts) ? "<script>$(function(){ {$scripts} });</script>" : '');
			$scripts = "";?>
		<br>
		</td>
	</tr>
	<tr>
		<td colspan="2"><p>е) <?=requiredTitle('Потребность в специализвированном гидрометеорологическом обеспечении<br>
 (предоставляется учреждениями федерального органа испольнительной власти в области гидрометорологниии<br>
 и мониторгинга окружающей среды по договору с заявителем)', 'mni_spec')?></p>
<textarea name="EXPEDITION[mni_spec]" id="mni_spec"><?=$arResult['EXPEDITION']['mni_spec']?></textarea></td>
	</tr>
</table>
</div>
<br>
<br>
