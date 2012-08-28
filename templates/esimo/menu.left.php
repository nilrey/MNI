<?php 
$arFirstRow = array_shift($arMenu);
//$arFirstRow = $arMenu[0];
$max_level = $arFirstRow['max_level'];
empty($arFirstRow['id']) ? $arFirstRow['id'] = 0 : null ;
$startFromId = $arFirstRow['id'];
?>
										
<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0">
	<TR>
		<TD><A HREF="<?=$arFirstRow['url'][0]?>" CLASS="submenu_title_01"><b><?=$arFirstRow['name']?></b></A></TD>
	</TR>
	<TR>
		<TD><IMG SRC="<?=TEMPLATE_PATH?>images/submenu_hline_01.gif" WIDTH="166" HEIGHT="2" BORDER="0" CLASS="submenu_div" ALT=" "></TD>
	</TR>
</TABLE>

<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0">
<?foreach ($arMenu as $key=>$arItem){
//	if ($key == 0 ) {
//		continue;
//	}
		$selected = 'off';
		if(!empty($arItem['selected'] )){
			$selected = 'on';
		}
		$levels = $arItem['level'] - $arParams['LEVEL'] + 1;
		$colspan = $max_level - $arItem['level'] +1;
		
		$sub_border = 'CLASS="submenu_01_bg"';
		if($levels > 1){
			if(!empty($arItem['parent']) && $arItem['parent'] == 'Y' ){
				//if($arItem['selected'] ){
					$icon = 'minus';
					$left_border = 'CLASS="submenu_02_corner_col01"';
					$icon_height = 9;
			}else	if(!empty($arItem['last_item']) && $arItem['last_item'] == 'Y'){
				$icon = 'corner';
				$left_border= '';
				$icon_height = 1;
				if($levels > 2) $sub_border = '';
				
			}else{
				$icon = 'corner_02';
				$left_border = 'CLASS="submenu_02_corner_col01"';
				$icon_height = 1;
			}
			
		?>
	<TR VALIGN="top">
	<?for ($i=2; $i < $levels; $i++){?>
		<TD WIDTH="9" CLASS="submenu_01_bg"></TD>
	<? } ?>
	<?if($levels >= 2){?>
		<TD <?=$sub_border?> WIDTH="9"><IMG SRC="<?=TEMPLATE_PATH?>images/submenu_ico_corner.gif" WIDTH="9" HEIGHT="9" ALT="" BORDER="0"></TD>
	<? } ?>
		<TD WIDTH="9" <?=$left_border?>><IMG SRC="<?=TEMPLATE_PATH?>images/submenu_ico_<?=$icon?>.gif" WIDTH="9" HEIGHT="<?=$icon_height?>" ALT="" BORDER="0"></TD>
	  <TD COLSPAN="<?=$colspan?>" WIDTH="100%"><A HREF="<?=$arItem['url'][0]?>" CLASS="submenu_01_<?=$selected?>"><?=$arItem['name']?></A></TD>
	</TR>
<?
		}else{
			if(!empty($arItem['parent']) && $arItem['parent'] == 'Y' ){
				//if($arItem['selected'] ){
					$icon = 'minus';
					$left_border = 'CLASS="submenu_01_bg"';
					$icon_height = 9;
			}else	if(!empty($arItem['last_item']) && $arItem['last_item'] == 'Y'){
				$icon = 'corner';
				$left_border= '';
				$icon_height = 9;
			}else{
				$icon = 'corner';
				$left_border = 'CLASS="submenu_01_bg"';
				$icon_height = 9;
			}

		?>
	<TR VALIGN="top">
    <TD WIDTH="9" <?=$left_border?>><IMG SRC="<?=TEMPLATE_PATH?>images/submenu_ico_<?=$icon?>.gif" WIDTH="9" HEIGHT="<?=$icon_height?>" ALT="" BORDER="0"></TD>
    <TD WIDTH="100%" COLSPAN="<?=$colspan?>"><A HREF="<?=$arItem['url'][0]?>" CLASS="submenu_01_<?=$selected?>"><?=$arItem['name']?></A></TD>
	</TR>
<?
			
		}
}
	
?>

</TABLE>