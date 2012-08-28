 <? $PAGE->setPageTitle('Запрос на экспедицию');?>
<?if(count($arResult['EXPEDITIONS']) > 0){
	
	?>
	<script>
	function clearSearchForm(){
		$('#kw_mni').val('');
		$('#kw_org').val('');
		$('#serach_department').val('');
	}
	</script>
<!--<p class="subtitle">Список экспедиций</p>-->
<form name="searchForm" method="GET" action="/mni/index.php">
<TABLE CELLSPACING="0" CELLPADDING="0" CLASS="tab" STYLE="border: 1px solid #cdcdcd">
	<tr>
		<td class="head">Ключевые слова в полях <br>"Название морских научных исследований" и "Цель морских научных исследований":</td>
		<td><input type="text" name="SEARCH[kw_mni]" id="kw_mni" size="100" value="<?=($arResult['SEARCH']['kw_mni'])?>"></td>
	</tr>
	<tr>
		<td class="head">Ведомство:</td>
		<td>
		<select class="input_text"  name="SEARCH[department]" id="serach_department">
			<option value="">
			<? foreach ($arResult['REFBOOK']['departments'] as $item) { 
					$selected = '';
					if($item['id'] == $arResult['SEARCH']['department']){
						$selected = ' selected ';
					}
				?>
				<option value="<?=$item['id']?>" <?=$selected?> ><?=$item['name']?>
			<? }?>
		</select>
		</td>
	<tr>
		<td class="head">Ключевые слова в названии организации:</td>
		<td><input type="text" name="SEARCH[kw_org]" id="kw_org" size="100" value="<?=($arResult['SEARCH']['kw_org'])?>"></td>
	</tr>
	<tr>
		<td colspan="2"><input type="button" onclick="document.searchForm.submit()" value="Отправить">
		<span style="padding-left: 20px"><input type="button" onclick="clearSearchForm()" value="Очистить"></span>
		</td>
	</tr>
</table>
</form>

<?}?>