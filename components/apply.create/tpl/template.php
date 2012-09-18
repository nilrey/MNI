<? $PAGE->setSectionTitle('Редактировать запрос');?>
<?
$act = '';
if(isset($_REQUEST['act'])){
	if( $_REQUEST['act'] === 'copy'){
		$act = $_REQUEST['act'];
	}elseif ($_REQUEST['act'] === 'save'){
		$act = $_REQUEST['act'];
		$message = 'Данные успешно сохранены';
		$_SERVER['REQUEST_URI'] = str_replace('&act=save', '', $_SERVER['REQUEST_URI']);
	}
}
?>
<? if(!empty($arResult['REPORT_FILE']['NAME'])){
		if(is_file($_SERVER['DOCUMENT_ROOT'].$arResult['REPORT_FILE']['PATH'])){
?>

<div class="modal hide" id="myModal">
  <div class="modal-header">
    <h3>Сохранить заявку</h3>
  </div>
  <div class="modal-body">
  	<p>Файл заявки сохранен в формате DOCX и упакован в архив ZIP</p>
    <p><a href="<?=$arResult['REPORT_FILE']['PATH']?>"><b>Скачать файл в архиве</b></a> </p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Закрыть</a>
  </div>
</div>
<script>$('#myModal').modal("show");</script>
<?
		}
	}
?>

<SCRIPT LANGUAGE="JavaScript" SRC="<?=TEMPLATE_PATH?>js/apply_functions.js" TYPE="text/javascript"></SCRIPT>
<?include_once('js.functions.php');?>
<?include_once('js.equip.php');?>

<p id="requiredFieldsErrorMessage" style="padding: 10px 0px; color: Red; font-size: 14px; font-weight: bold; display:none">Пожалуйста, заполните обязательные поля </p>
<br>

<?if (empty($arResult['EXPEDITION']['id']) && count($arResult['DEBTS']) > 0){
//	var_dump(count($arResult['DEBTS']));
		if(count($arResult['DEBTS']) > 0){
			echo '<p>Извините, создание новой записи невозможно по следующей причине: осутствует отметка о передаче отчета по следующим МНИ.</p>';
			echo '<table class="tab">';
			echo '<tr>';
			echo '<td class="head">#</td>';
			echo '<td class="head">Название экспедиции</td>';
			echo '<td class="head">Отчетная организация</td>';
			echo '</tr>';
			$i=0;
			foreach ($arResult['DEBTS'] as $arItem){
				echo "<tr onmouseover=\"this.style.background='#E6E6FA'\" onmouseout=\"this.style.background='#fff'\"><td>".++$i."</td><td>{$arItem['mni_name']}</td><td>{$arResult['USER_GROUPS'][$arItem['group_id']]['name']}</td></tr>";
			}
			echo '</table>';
		}

	}else{

//echo '<br>';
//$a = 27.89;
//$minut = ( ($a - intval($a) ) / 60);
//$b = round($minut, 6);
//echo round($b*60, 2)
?>

<div class="section">
  <div class="tabs"">
    <span class="current">Организации</span>
    <span>Транспорт</span>
    <span>Маршрут</span>
    <span>Программа</span>
    <span>Технические средства</span>
    <span>Другое</span>
  </div>
    <span style="padding-left: 30px;"></span>
    <input type="button" class="btn" name="submit" value="Сохранить запрос" onclick="checkAppForm()">
    <span style="padding-left: 30px;"></span>
    <input type="button" class="btn" name="submit" value="Сохранить в файл" onclick="window.location.href='<?=$arResult['BASE_URL'].'&print=1'?>'">
		<br>
<!---------------------- FORM ------------------------------------------>

<form name="applicationForm" method="POST" action="<?=$arResult['BASE_URL']?>" enctype="multipart/form-data">
<input type="hidden" name="eid" value="<?=(!empty($arResult['EXPEDITION']['id']) ? $arResult['EXPEDITION']['id'] : null)?>">
<input type="hidden" name="act" value="<?=$act?>">
<input type="hidden" name="atab" id="atab" value="<?if(!empty($_REQUEST['atab']) && intval($_REQUEST['atab']) > 0){echo intval($_REQUEST['atab']); }else{echo '0';}?>">
<!---------------------- ORGANIZATIONS --------------------------------->

  <div class="box visible">
		<? include_once('inc.appllicant.php')?>
		<br>
		<br>
		<? include_once('inc.executor.php')?>
		<br>
		<br>
		<? include_once('inc.participant.php')?>
		<br>
		<br>
  </div>

<!---------------------- TRANSPORT ------------------------------------->

  <div class="box">
		<? include_once('inc.transport.php')?>
  </div>

<!---------------------- ROOT ------------------------------------------>

  <div class="box">
  	<? include_once('inc.root.php')?>
  </div>

<!---------------------- PROGRAM --------------------------------------->

  <div class="box">
  	<? include_once('inc.prog.php')?>
  </div>

<!---------------------- DEVICES AND EQUIPMENT ------------------------->

  <div class="box">
  	<? include_once('inc.tech.php')?>
  </div>

<!---------------------- OTHER ---------------------------------------->

  <div class="box">
	  <? include_once('inc.other.php')?>
  </div>
</div><!-- .section -->

</form>

<!---------------------- \ FORM ---------------------------------------->
<!--<input type="button" onclick="alert(document.getElementById('atab').value())">-->
<?php
}
if(!empty($_REQUEST['atab']) && intval($_REQUEST['atab']) > 0){
	$tab = intval($_REQUEST['atab']);
	echo "<SCRIPT LANGUAGE='JavaScript'>setCurrentTab({$tab})</SCRIPT>";
} ?>

<?if(!empty($message) ){?>
<script>showMessage("<?=$message?>");</script>
<?}?>
