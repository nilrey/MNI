<?php
outputHandlerCut(&$PAGE->arOutput);
outputHandlerClose(); // STOP COLLECT OUTPUT
//$DB->close();

//var_dump($PAGE->USER->isAdmin() );

$ACCESS_TO_PAGE = 'Y';
if(count($PAGE->getPageAccess()) > 0 && !$USER->isAdmin()){
	if( count(array_intersect($PAGE->getPageAccess(), $USER->getGroups())) > 0 ){
		$ACCESS_TO_PAGE = 'Y';
	}else {
		$ACCESS_TO_PAGE = 'N';
	}
}

include($_SERVER['DOCUMENT_ROOT'].'/templates/'.$PAGE->getTemplateMain().'/header.tpl.php');

// OUTPUT
if ($ACCESS_TO_PAGE == 'Y'){
	foreach ($PAGE->arOutput as $out) {
	 	echo $out['OUTPUT'];
	}
}else{
	include_once(TEMPLATE_ACCESS_DENIED);
}

include($_SERVER['DOCUMENT_ROOT'].'/templates/'.$PAGE->getTemplateMain().'/footer.tpl.php');

?>