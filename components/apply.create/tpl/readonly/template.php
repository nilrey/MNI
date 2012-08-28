<? $PAGE->setPageTitle('Запрос на экспедицию');?>
<?
//var_dump($arResult);
$act = '';
if ($_REQUEST['act'] === 'save'){
	$act = $_REQUEST['act'];
	$message = 'Данные успешно сохранены';
	$_SERVER['REQUEST_URI'] = str_replace('&act=save', '', $_SERVER['REQUEST_URI']);
}
?>
<? if(!empty($arResult['REPORT_FILE']['NAME'])){
		if(is_file($_SERVER['DOCUMENT_ROOT'].$arResult['REPORT_FILE']['PATH'])){
			?>

<div class="modal hide" id="myModal">
  <div class="modal-header">
    <h3>Сохранить документ</h3>
  </div>
  <div class="modal-body">
<!--  	<p>Уважаемый, пользователь <?=$USER->getUserName()?></p>-->
  	<p>Файл сохранен в формате DOCX и упакован в архив ZIP</p>
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

<!--<SCRIPT LANGUAGE="JavaScript" SRC="<?=TEMPLATE_PATH?>js/apply_functions.js" TYPE="text/javascript"></SCRIPT>-->
<?//include_once('js.functions.php');?>

<br>
<div class="section">
  <div class="tabs"">
    <span class="current">Организации</span>
    <span>Транспорт</span>
    <span>Маршрут</span>
    <span>Программа</span>
    <span>Технические средства</span>
    <span>Другое</span>
  </div>
<?if ($arParams['FORM_SEND_ENABLE'] == 'Y'){?>
    <span style="padding-left: 30px;"></span>
    <input type="button" class="btn" name="submit" value="Сохранить изменения" onclick="checkRequiredFields()"> 
<?}?>
  <span style="padding-left: 30px;"></span>
  <input type="button" class="btn" name="submit" value="Сохранить в файл" onclick="window.location.href='<?=$arResult['BASE_URL'].'&print=1'?>'"> 
<br>

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

  <div class="box ">
  	<? include_once('inc.root.php')?>
  </div>

<!---------------------- PROGRAM --------------------------------------->

  <div class="box ">
  	<? include_once('inc.prog.php')?>
  </div>

<!---------------------- DEVICES AND EQUIPMENT ------------------------->

  <div class="box ">
  	<? include_once('inc.tech.php')?>
  </div>

<!---------------------- OTHER ---------------------------------------->

<!---------------------- FORM ------------------------------------------>
<?if ($arParams['FORM_SEND_ENABLE'] == 'Y'){?>
<form name="applicationForm" method="POST" action="<?=$_SERVER['REQUEST_URI']?>" enctype="multipart/form-data">
<input type="hidden" name="eid" value="<?=$arResult['EXPEDITION']['id']?>">
<input type="hidden" name="act" value="<?=$act?>">
<?}?>
  <div class="box">
	  <? include_once('inc.other.php')?>
  </div>
</div><!-- .section -->
<?if ($arParams['FORM_SEND_ENABLE'] == 'Y'){?>
</form>
<?}?>

<!---------------------- \ FORM ---------------------------------------->
