<?if($USER->getUserId() > 0 ){	?>
											<SPAN CLASS="subtitle_login"><?=$USER->getUserName()?></SPAN><BR>
                                            <SPAN class="text_small_light">01:15.24&nbsp;<a href="#"><IMG SRC="<?=TEMPLATE_PATH?>images/quest.png" ALT="?" WIDTH="11" HEIGHT="11" BORDER="0"></a></SPAN><BR>
                                            <IMG SRC="/templates/esimo/images/dot.gif" width="1" height="5" ALT="" border="0"/><BR>
                                            <A HREF="#" CLASS="menu_01_btn_03"><IMG SRC="/templates/esimo/images/dot.gif" width="1" height="5" ALT="" border="0"/></A><BR/>
                                            <A HREF="#" CLASS="menu_01_btn_03"><IMG SRC="/templates/esimo/images/dot.gif" width="1" height="5" ALT="" border="0"/></A><BR/>
                                            <A HREF="?logout=1" CLASS="menu_01_btn_03"><b>Выход</b></A>
<? }else{ ?>
											<FORM METHOD="post" NAME="login_form" ID="login_form" CLASS="login_form">
											<input type="hidden" name="auth_submit" value="1">
											<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
											<TR>
												<TD COLSPAN="3" HEIGHT="22" VALIGN="top"><INPUT TYPE="text" NAME="login" VALUE=" Имя" CLASS="input_text" STYLE="width: 169px; height: 20px;" onfocus="if(this.value == ' Имя') this.value = ''" onblur="if(this.value == '') this.value=' Имя'"></TD>
											</TR>
											<TR>
												<TD COLSPAN="3" HEIGHT="24"><INPUT TYPE="password" NAME="password" VALUE=" Пароль" CLASS="input_text" STYLE="width: 169px; height: 20px;" onfocus="if(this.value == ' Пароль') this.value = ''" onblur="if(this.value == '') this.value=' Пароль'"></TD>
											</TR>
											<TR STYLE="padding-top: 4px;" VALIGN="middle">
												<TD CLASS="form_text" WIDTH="115">&nbsp;<a href="/personal/registration.php" class="registration"><b>Регистрация</b></a> <A HREF="#"><IMG SRC="<?=TEMPLATE_PATH?>images/quest.png" ALT="Зачем нужна регистрация?" BORDER="0"></A></TD>
												<TD WIDTH="6"><IMG SRC="<?=TEMPLATE_PATH?>images/login_vline.gif" WIDTH="2" HEIGHT="24" BORDER="0" ALT=" "></TD>
												<TD WIDTH="48"><A HREF="#" onMouseOver="ChangeImg('login','login_over')" onMouseOut="ChangeImg('login','login_out')" onClick="document.forms['login_form'].submit(); return true;"><IMG SRC="<?=TEMPLATE_PATH?>images/login_btn_01.gif" WIDTH="48" HEIGHT="24" BORDER="0" ID="login" NAME="login" ALT="Войти"></A></TD>
											</TR>
											</TABLE>
											</FORM>
<? } ?>