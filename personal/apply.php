<?require($_SERVER["DOCUMENT_ROOT"]."/header.php");
$PAGE->setPageAccess(array(3));
?>
 <? //$PAGE->setPageTitle('Создать запрос');?>
<? $PAGE->IncludeComponent('apply.create');?>

<?require($_SERVER["DOCUMENT_ROOT"]."/footer.php");?>