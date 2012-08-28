<?php
function outputHandlerOpen(){
	@ob_start();
}
function outputHandlerClose(){
	@ob_end_flush();
}
function outputHandlerClean(){
	@ob_end_clean();
}
function outputHandlerCut(&$output, $type = 'HTML'){
	 $arTmp['TYPE'] = $type;
	 $arTmp['OUTPUT'] = ob_get_contents();
	 $output[] = $arTmp;
	outputHandlerClean();
//	outputHandlerClose();
	outputHandlerOpen();
}
function outputHandlerOn(){
	return true;
}

?>