<p class="subtitle">10. Программа морских научных исследований </p>
<div class="shiftLeft20">
<table class="tab" style="border: 0px">
	<tr>
		<td>а) Название </td><td><?=$arResult['EXPEDITION']['mni_name']?></td>
	</tr>
	<tr>
		<td>б) Цель </td><td><?=$arResult['EXPEDITION']['mni_aim']?></td>
	</tr>
	<tr>
		<td colspan="2"><p>в) Виды морских научных исследований (работ), методы и последовательность их выполнения</p>
		 <table id="tablemnitypes" class="tab">
		 <tbody>
		 <tr>
		 	<td class="head">№</td>
		 	<td class="head">Тип наблюдений</td>
		 	<td class="head">Вид наблюдений</td>
		 	<td class="head">Структурная единица</td>
		 	<td class="head">Количество</td>
		 </tr>
				<?if( count($arResult['MNITYPE']['meteo']) > 0 ){			
					foreach ($arResult['MNITYPE']['meteo'] as $key=>$arItem){
						$counter = $key + 1;
						$coordType = 'meteo';
						$mnitype = '';
						$mnisort = '';
						$mniunit = '';
						foreach ($arResult['REFBOOK']['mnitype'] as $arValue) {
							if($arValue['code'] == $arItem['mnitype']){
								$mnitype = $arValue['name'];
							}
						}
						foreach ($arResult['REFBOOK']['mnisort'] as $arValue) {
							if($arValue['code'] == $arItem['mnisort']){
								$mnisort = $arValue['name'];
							}
						}
						foreach ($arResult['REFBOOK']['mniunit'] as $arValue) {
							if($arValue['id'] == $arItem['mniunit']){
								$mniunit = $arValue['name'];
							}
						}
						
						?>
		<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		 <td><?=$counter?></td><td><?=$mnitype?></td><td><?=$mnisort?></td><td><?=$mniunit?></td><td><?=$arItem['amount']?></td>
		</tr>
						<?
					}
				}?>  
		 </tbody>
		 </table>
		<br>
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
	 	<td class="head">Дата прохождения<br />(YYYY-MM-DD)</td>
	 	<td class="head">Географическая широта<br />(в градусах, минутах и долях минут)</td>
	 	<td class="head">Географическая долгота<br />(в градусах, минутах и долях минут)</td>
	 	<td class="head">&nbsp</td>
	 </tr>
			<?if( count($arResult['COORDS']['mnishore']) > 0 ){			
				foreach ($arResult['COORDS']['mnishore'] as $key=>$arItem){
					$counter = $key + 1;
					$coordType = 'mnishore';
					list($latGrad, $latMin) = explode(';', $arItem['latitiude']);
					list($langGrad, $langMin, $langType) = explode(';', $arItem['langitude']);
					$fields = '<tr id="tr'.$counter.'" onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'">';
					$fields .= '<td>'.$counter.'</td>';
					$fields .= '<td>';
					$fields .= $arItem['landing_date'];
					$fields .= '</td>';
					
					$fields .= '<td>';
					$fields .= $latGrad.'&#176&nbsp;';
					
					$fields .= $latMin.'&#39 с.ш.';
					$fields .= '</td>';
					
					$fields .= '<td>';
					$fields .= $langGrad.'&#176&nbsp;';
					$fields .= $langMin.'&#39';
					$fields .= ($langType == 'в.д.' ? ' в.д. ' : '');
					$fields .= ($langType == 'з.д.' ? ' з.д. ' : '');
					$fields .= '</td>';
					
					$fields .= '</tr>';
					
					echo $fields;
					
				}
			}?>  
			
			
	 </tbody>
	 </table>
		</td>
	</tr>
	<tr>
		<td colspan="2"><p>д) географические координаты (в градусах, минутах и долях минут) мест предполагаемых высадок на лед</p>
	 <table id="tablemniice" class="tab">
	 <tbody>
	 <tr>
	 	<td class="head">№ точки</td>
	 	<td class="head">Дата прохождения<br />(YYYY-MM-DD)</td>
	 	<td class="head">Географическая широта<br />(в градусах, минутах и долях минут)</td>
	 	<td class="head">Географическая долгота<br />(в градусах, минутах и долях минут)</td>
	 	<td class="head">&nbsp</td>
	 </tr>
			<?if( count($arResult['COORDS']['mniice']) > 0 ){			
				foreach ($arResult['COORDS']['mniice'] as $key=>$arItem){
					$counter = $key + 1;
					$coordType = 'mniice';
					list($latGrad, $latMin) = explode(';', $arItem['latitiude']);
					list($langGrad, $langMin, $langType) = explode(';', $arItem['langitude']);
					$fields = '<tr id="tr'.$counter.'" onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'">';
					$fields .= '<td>'.$counter.'</td>';
					$fields .= '<td>';
					$fields .= $arItem['landing_date'];
					$fields .= '</td>';
					
					$fields .= '<td>';
					$fields .= $latGrad.'&#176&nbsp;';
					
					$fields .= $latMin.'&#39 с.ш.';
					$fields .= '</td>';
					
					$fields .= '<td>';
					$fields .= $langGrad.'&#176&nbsp;';
					$fields .= $langMin.'&#39';
					$fields .= ($langType == 'в.д.' ? ' в.д. ' : '');
					$fields .= ($langType == 'з.д.' ? ' з.д. ' : '');
					$fields .= '</td>';
					
					$fields .= '</tr>';
					
					echo $fields;
					
				}
			}?>  
			
			
	 </tbody>
	 </table>
		</td>
	</tr>
	<tr>
		<td colspan="2"><p>е) потребность в специализвированном гидрометеорологическом обеспечении<br>
 (предоставляется учреждениями федерального органа испольнительной власти в области гидрометорологниии<br>
 и мониторгинга окружающей среды по договору с заявителем)</p>
<?=$arResult['EXPEDITION']['mni_spec']?></td>
	</tr>	
</table>
</div>
<br>
<br>
