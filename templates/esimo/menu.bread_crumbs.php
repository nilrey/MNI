										<SPAN CLASS="menu_02">
<?php
foreach ($arBreadCrumbs as $key=>$value) {
	$separator = ' / ';
	if($key == (count($arBreadCrumbs) -1)){
		$separator = '';
	}
?>
											<A HREF="<?=$value['url'][0]?>" CLASS="menu_02"><?=$value['name']?></A><?=$separator?>
<?
}
?>
										</SPAN>
