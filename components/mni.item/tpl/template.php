<? $PAGE->setPageTitle('Экспедиция');?>

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

<?if(!empty($arResult['QSTRING'])){?>
<p style="padding: 10px 0px;">
<a style=" font-weight: bold; font-size: 12" href="/mni/index.php<?=$arResult['QSTRING']?>" >&laquo; Вернуться к результатам поиска</a>
</p>
<?}else{?>
<br/>
<?}?>
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

  <div class="box">
	  <? include_once('inc.other.php')?>
  </div>
</div><!-- .section -->
