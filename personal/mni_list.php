<?require($_SERVER["DOCUMENT_ROOT"]."/header.php");
$PAGE->setPageAccess(array(3));
?>

<? $PAGE->IncludeComponent('apply.list', array("STATUS" => array(20,21,22,30), 'ORDERBY'=>'MNI', "template"=> "template_mni"));?>

<?require($_SERVER["DOCUMENT_ROOT"]."/footer.php");?>