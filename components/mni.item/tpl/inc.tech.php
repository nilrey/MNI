<p class="subtitle">11. Технические средства морс ких научных исследований (основные характеристики, официальное наименование и юридический адрес владельца), за исключением предусмотренных пунктом 12 </p>
<div class="shiftLeft20">
<input type="hidden" name="TECH[eid]" value="<?=$arResult['TECH']['exp_id']?>">
<table class="tab" style="border: 0px">
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td>а) гидрографические </td><td>
		<?=$arResult['TECH']['hydrograph']?></td>
	</tr>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td>б) гидроакустические </td><td>
		<?=$arResult['TECH']['hydroacustic']?></td>
	</tr>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td>в) магнитометрические </td><td>
		<?=$arResult['TECH']['magnitometr']?></td>
	</tr>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td>г) сейсмические </td><td>
		<?=$arResult['TECH']['seismic']?></td>
	</tr>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td>д) метеорологические </td><td>
		<?=$arResult['TECH']['meteorolog']?></td>
	</tr>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td>ж) океанографические </td><td>
		<?=$arResult['TECH']['oceanograph']?></td>
	</tr>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td>з) оборудование для<br>
 биологических исследований </td><td>
		<?=$arResult['TECH']['bioresearch']?></td>
	</tr>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td>и) оборудование для взятия<br> проб воды, грунта, донных отложений, <br>биологических и других проб </td><td>
		<?=$arResult['TECH']['probation']?></td>
	</tr>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td>к) ныряющие устройства </td><td>
		<?=$arResult['TECH']['divingdev']?></td>
	</tr>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td>л) заякоренные устройства</td><td>
		<?=$arResult['TECH']['ancoreddev']?></td>
	</tr>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td>м) буксируемые устройства </td><td>
		<?=$arResult['TECH']['coupleddev']?></td>
	</tr>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td>н) обитаемые и необитаемые <br>аппараты </td><td> 
		<?=$arResult['TECH']['submarine']?></td>
	</tr>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td>о) летательные аппараты </td><td>
		<?=$arResult['TECH']['planes']?></td>
	</tr>
	<tr onmouseover="this.style.background='#E6E6FA'" onmouseout="this.style.background='#fff'">
		<td>п) другое оборудование </td><td>
		<?=$arResult['TECH']['otherdev']?></td>
	</tr>
</table>
</div>
<br>
<br>
<p class="subtitle">12. Независимые автоматические научно-исследовательские устрановки и оборудование</p>
 <table id="tableequip" class="tab">
 <tbody>
 <tr>
 	<td class="head">№</td>
 	<td class="head">Основные характеристики</td>
 	<td class="head">Характер получаемой информации и способ ее передачи</td>
 	<td class="head">Географические координаты (в градусах, минутах и долях минут) района использования (места постановки)</td>
 	<td class="head">Даты (YYYY-MM-DD) постановки и демотажа, время действия</td>
 	<td class="head">официальное наименование и юридический адрес владельца</td>
 </tr>
		<?if( count($arResult['EQUIP']) > 0 ){			
			foreach ($arResult['EQUIP'] as $key=>$arItem){
				$counter = $key + 1;
//				list($latGrad, $latMin) = explode(';', $arItem['latitiude']);
//				list($langGrad, $langMin, $langType) = explode(';', $arItem['langitude']);
				$fields = '<tr id="tr'.$counter.'" onmouseover="this.style.background=\'#E6E6FA\'" onmouseout="this.style.background=\'#fff\'">';
				$fields .= '<td>'.$counter.'</td>';
				$fields .= '<td>';
				$fields .= $arItem['basic'].'</td>';
				$fields .= '<td>'.$arItem['infotype'].'</td>';
				$fields .= '<td>'.$arItem['coord'].'</td>';
				$fields .= '<td>'.$arItem['dates'].'</td>';
				$fields .= '<td>'.$arItem['owner'].'</td>';
				
				$fields .= '</tr>';
				
				echo $fields;
			}
		}?>  
		
		
 </tbody>
 </table>
<br>
<br>
