<?require($_SERVER["DOCUMENT_ROOT"]."/header.php");
$PAGE->setPageAccess(array(1));
?>

<? $PAGE->IncludeComponent('admin.users.list', array("DEBUG" => false)); ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/footer.php");?>