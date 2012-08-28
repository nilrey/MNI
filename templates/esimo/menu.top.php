<?
//echo'<pre>';
//print_r($arMenu);
//echo'</pre>';

?>
			<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0">
					<TR>
						<TD WIDTH="50%"><IMG SRC="/teplates/esimo/images/globalmenu_img_01.gif" WIDTH="4" HEIGHT="27" BORDER="0" ALT=" "></TD>
						<!-- *** -->
						
					<?$UNDERLINE_STYLE = '<TD></TD>';
					foreach ($arMenu as $arItem){
							if($arItem['level'] <= $arParams['LEVEL']){
								if(!empty($arItem['selected']) ){
									$UNDERLINE_STYLE .= '<TD CLASS="globalmenu_underline" COLSPAN="3"></TD>';
						?>
						<TD WIDTH="1"><IMG SRC="<?=TEMPLATE_PATH?>images/globalmenu_border_02.gif" WIDTH="1" HEIGHT="27" BORDER="0" ALT=" "></TD>
						<TD CLASS="globalmenu_02" nowrap><A HREF="<?=$arItem['url'][0]?>" CLASS="menu_01_btn_02"><?=$arItem['name']?></A></TD>
						<TD WIDTH="1"><IMG SRC="<?=TEMPLATE_PATH?>images/globalmenu_border_02.gif" WIDTH="1" HEIGHT="27" BORDER="0" ALT=" "></TD>
						<TD WIDTH="1"><IMG SRC="<?=TEMPLATE_PATH?>images/globalmenu_div.gif" WIDTH="1" HEIGHT="27" BORDER="0" ALT=" "></TD>
					
						<?	}else{ 
									$UNDERLINE_STYLE .= '<TD></TD><TD></TD><TD></TD>';
							?>
						<TD WIDTH="1"><IMG SRC="<?=TEMPLATE_PATH?>images/globalmenu_border_01.gif" WIDTH="1" HEIGHT="27" BORDER="0" ALT=" "></TD>
						<TD CLASS="globalmenu_01" nowrap><A HREF="<?=$arItem['url'][0]?>" CLASS="menu_01_btn_01"><?=$arItem['name']?></A></TD>
						<TD WIDTH="1"><IMG SRC="<?=TEMPLATE_PATH?>images/globalmenu_border_01.gif" WIDTH="1" HEIGHT="27" BORDER="0" ALT=" "></TD>
						<TD WIDTH="1"><IMG SRC="<?=TEMPLATE_PATH?>images/globalmenu_div.gif" WIDTH="1" HEIGHT="27" BORDER="0" ALT=" "></TD>
						<?	}
							}
						}?>
						
						<TD WIDTH="50%" ALIGN="right"><IMG SRC="<?=TEMPLATE_PATH?>images/globalmenu_img_02.gif" WIDTH="4" HEIGHT="27" BORDER="0" ALT=" "></TD>
					</TR>
					<TR>
						<?=$UNDERLINE_STYLE?>
						
					</TR>
				</TABLE>
