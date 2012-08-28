<?require($_SERVER["DOCUMENT_ROOT"]."/header.php");
$PAGE->setPageAccess(array(4));
?>

<? $PAGE->IncludeComponent('mon.list', array("STATUS" => array(20,21,22,30), "template"=> "template_mni"));?>

<?require($_SERVER["DOCUMENT_ROOT"]."/footer.php");?>