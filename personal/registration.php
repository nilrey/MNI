<?require($_SERVER["DOCUMENT_ROOT"]."/header.php"); ?>
<?//$PAGE->setPageAccess(array(2));?>

<!--<p>Извините, свободная регистрация временно недоступна.</p>-->

<? $PAGE->IncludeComponent('registration');?>

<?require($_SERVER["DOCUMENT_ROOT"]."/footer.php");?>