<?require($_SERVER["DOCUMENT_ROOT"]."/header.php");
$PAGE->setPageAccess(array(3));
?>

<? $PAGE->IncludeComponent('apply.list', array("STATUS" => array(0,10,11,12,13), 'ORDERBY'=>'APP') );?>

<?require($_SERVER["DOCUMENT_ROOT"]."/footer.php");?>