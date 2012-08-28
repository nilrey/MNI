<p class="subtitle">6. Маршрут движения судна от точки пересечения границы Российской Федерации до района морских научных исследований и обратно (для иностранных судов)</p>  
 <table id="tableshiproot" class="tab">
 <tbody>
 <tr>
 	<td class="head">№ точки</td>
 	<td class="head">Дата прохождения<br />(YYYY-MM-DD)</td>
 	<td class="head">Географическая широта<br />(в градусах, минутах и долях минут)</td>
 	<td class="head">Географическая долгота<br />(в градусах, минутах и долях минут)</td>
 </tr>
		<?
		$scripts = '';
		$fields = '';
		if( count($arResult['COORDS']['shiproot']) > 0 ){			
			foreach ($arResult['COORDS']['shiproot'] as $key=>$arItem){
				$counter = $key + 1;
				$coordType = 'shiproot';
				list($latGrad, $latMin) = explode(';', $arItem['latitiude']);
				list($langGrad, $langMin, $langType) = explode(';', $arItem['langitude']);
				$fields = '<tr id="tr'.$counter.'" onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'">';
				$fields .= '<td>'.$counter.'</td>';
				$fields .= '<td>';
				$fields .= ''.$arItem['landing_date'].'';
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
<br>
<br>
<p class="subtitle">7. Названия потров Российской Федерации, дата, (YYYY-MM-DD) и цель их посещения (для иностранных судов)</p>
 <table id="tableports" class="tab">
 <tbody>
 <tr>
 	<td class="head">№</td>
 	<td class="head">Дата прохождения<br />(YYYY-MM-DD)</td>
 	<td class="head">Название</td>
 	<td class="head">Цель посещения (для иностранных судов)</td>
 </tr>
		<?
		$scripts = '';
		$fields = '';
		if( count($arResult['PORTS']['ports']) > 0 ){			
			foreach ($arResult['PORTS']['ports'] as $key=>$arItem){
				$counter = $key + 1;
				$coordType = 'ports';
				$fields = '<tr id="tr'.$counter.'" onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'">';
				$fields .= '<td>'.$counter.'</td>';
				$fields .= '<td>';
				$fields .= $arItem['landing_date'];
				$fields .= '</td>';
				
				$fields .= '<td>';
				$fields .= $arItem['port'];
				$fields .= '</td>';
				
				$fields .= '<td>';
				$fields .= $arItem['comment'];
				$fields .= '</td>';
				
				$fields .= '</tr>';
				
				echo $fields;
			}
		}?>  
		
		
 </tbody>
 </table>
<br>
<br>

<p class="subtitle">8. Дата первого прибытия в район морских научных исследований:&nbsp;&nbsp;&nbsp;<?=$arResult['EXPEDITION']['date_start']?>
<br>&nbsp;&nbsp;&nbsp;
Дата окончательного ухода  из района морских научных исследований:&nbsp;&nbsp;&nbsp;<?=$arResult['EXPEDITION']['date_end']?></p>
<br>
<p class="subtitle">9. Координаты района морских научных исследований</p>
 <table id="tablemniregion" class="tab">
 <tbody>
 <tr>
 	<td class="head">№ точки</td>
 	<td class="head">Дата прохождения<br />(YYYY-MM-DD)</td>
 	<td class="head">Географическая широта<br />(в градусах, минутах и долях минут)</td>
 	<td class="head">Географическая долгота<br />(в градусах, минутах и долях минут)</td>
 </tr>
		<?if( count($arResult['COORDS']['mniregion']) > 0 ){			
			foreach ($arResult['COORDS']['mniregion'] as $key=>$arItem){
				$counter = $key + 1;
				$coordType = 'mniregion';
				list($latGrad, $latMin) = explode(';', $arItem['latitiude']);
				list($langGrad, $langMin, $langType) = explode(';', $arItem['langitude']);
				$fields = '<tr id="tr'.$counter.'" onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'">';
				$fields .= '<td>'.$counter.'</td>';
				$fields .= '<td>';
				$fields .= $arItem['landing_date'];
				$fields .= '</td>';
				
				$fields .= '<td>';
				$fields .= $latGrad.'&#176 &nbsp;';
				
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
<br>
<br>
<p class="subtitle">&nbsp;&nbsp;&nbsp;&nbsp;Маршрут движения судна в районе морских научных исследований (если исследования осуществляются по маршруту) </p>
 <table id="tablemniroot" class="tab">
 <tbody>
 <tr>
 	<td class="head">№ точки</td>
 	<td class="head">Дата прохождения<br />(YYYY-MM-DD)</td>
 	<td class="head">Географическая широта<br />(в градусах, минутах и долях минут)</td>
 	<td class="head">Географическая долгота<br />(в градусах, минутах и долях минут)</td>
 </tr>
		<?if( count($arResult['COORDS']['mniroot']) > 0 ){			
			foreach ($arResult['COORDS']['mniroot'] as $key=>$arItem){
				$counter = $key + 1;
				$coordType = 'mniroot';
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

<br>
<br>