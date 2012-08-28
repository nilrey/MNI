<?require($_SERVER["DOCUMENT_ROOT"]."/header.php");
$PAGE->setPageAccess(array(4));
?>
<? $PAGE->IncludeComponent('mon.list', array("STATUS" => array(10,11,12,13) ) );?>

<?require($_SERVER["DOCUMENT_ROOT"]."/footer.php");?>