 <? $PAGE->setPageTitle('Авторизация');
 //$PAGE->setSectionTitle('Авторизация');?>
 
 <?if($USER->getUserId() > 0 ){	?>
											<p>Добрый день, <SPAN CLASS="subtitle_login"><?=$USER->getUserName()?></SPAN></p>
											<p>Вы успешно авторизованы.</p>
                      <p>
                      <input type="button" class="btn" onClick='window.location="/personal/login.php?logout=1"' value="Выход">
                      </p>
<? }else{ 
	if($USER->isAuthorizationError()){
		echo $USER->getAuthorizationErrorMessage();
	}
	?>
											<FORM METHOD="post" NAME="login_form2" ID="login_form2">
											<input type="hidden" name="auth_submit" value="1">
											<p>
											<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
											<TR>
												<TD COLSPAN="1" HEIGHT="22" VALIGN="top"><INPUT TYPE="text" NAME="login" VALUE=" Имя" CLASS="input_text" STYLE="width: 169px; height: 20px;" onfocus="if(this.value == ' Имя') this.value = ''" onblur="if(this.value == '') this.value=' Имя'"></TD>
											</TR>
											<TR>
												<TD COLSPAN="1" HEIGHT="24"><INPUT TYPE="password" NAME="password" VALUE=" Пароль" CLASS="input_text" STYLE="width: 169px; height: 20px;" onfocus="if(this.value == ' Пароль') this.value = ''" onblur="if(this.value == '') this.value=' Пароль'"></TD>
											</TR>
											<TR>
												<TD STYLE="padding-top: 6px;"><input type="button" class="btn" onClick="document.forms['login_form2'].submit(); return true;" value="Войти"></TD>
											</TR>
											<TR>
												<TD STYLE="padding-top: 12px;">
												<input type="button" class="btn" onClick='window.location="/personal/registration.php"' value="Регистрация">
												</TD>
											</TR>
											</TABLE>
											</p>
											</FORM>
<? } ?>