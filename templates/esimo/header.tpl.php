<HTML>
<HEAD>
	<TITLE><?php echo $PAGE->pageTitle?></TITLE>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
	<META HTTP-EQUIV="pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="cache-control" CONTENT="no-cache">
	<META HTTP-EQUIV="Expires" CONTENT="0">
	<META NAME="description" CONTENT=" ">
	<META NAME="keywords" CONTENT=" ">
	<LINK HREF="<?=TEMPLATE_PATH?>css/main.css" REL="stylesheet" TYPE="text/css">
	<LINK HREF="<?=TEMPLATE_PATH?>css/substyle.css" REL="stylesheet" TYPE="text/css">
	<link type="text/css" href="<?=TEMPLATE_PATH?>css/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
<!--	<LINK HREF="<?=TEMPLATE_PATH?>css/modalw.css" REL="stylesheet" TYPE="text/css">-->
	<LINK HREF="<?=TEMPLATE_PATH?>css/jquery.datepick.css" REL="stylesheet" TYPE="text/css">
	<LINK HREF="<?=TEMPLATE_PATH?>css/redmond.datepick.css" REL="stylesheet" TYPE="text/css">

	<SCRIPT LANGUAGE="JavaScript" SRC="<?=TEMPLATE_PATH?>js/jquery.min.js" TYPE="text/javascript"></SCRIPT>

	<SCRIPT LANGUAGE="JavaScript" SRC="<?=TEMPLATE_PATH?>js/jquery-1.7.2.min.js" TYPE="text/javascript"></SCRIPT>
	<script type="text/javascript" src="<?=TEMPLATE_PATH?>js/jquery-ui-1.8.21.custom.min.js"></script>
	<SCRIPT LANGUAGE="JavaScript" SRC="<?=TEMPLATE_PATH?>js/main.js" TYPE="text/javascript"></SCRIPT>
	<SCRIPT LANGUAGE="JavaScript" SRC="<?=TEMPLATE_PATH?>js/jquery.autocomplete.js" TYPE="text/javascript"></SCRIPT>
<!--	<SCRIPT LANGUAGE="JavaScript" SRC="<?=TEMPLATE_PATH?>js/modalw.js" TYPE="text/javascript"></SCRIPT>-->
	<SCRIPT LANGUAGE="JavaScript" SRC="<?=TEMPLATE_PATH?>js/jquery.datepick.js" TYPE="text/javascript"></SCRIPT>
	<SCRIPT LANGUAGE="JavaScript" SRC="<?=TEMPLATE_PATH?>js/jquery.datepick-ru.js" TYPE="text/javascript"></SCRIPT>
	<SCRIPT LANGUAGE="JavaScript" SRC="<?=TEMPLATE_PATH?>js/jquery.scrollTo-min.js" TYPE="text/javascript"></SCRIPT>
	<SCRIPT LANGUAGE="JavaScript" SRC="<?=TEMPLATE_PATH?>js/init.js" TYPE="text/javascript"></SCRIPT>
</HEAD>
<BODY>
<A NAME="page_top"></A>
<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" ALIGN="center">
<TR VALIGN="top">
	<TD CLASS="body_border_01" ROWSPAN="2" WIDTH="11">
		<TABLE WIDTH="11" BORDER="0" CELLPADDING="0" CELLSPACING="0">
		<TR>
			<TD CLASS="body_border_03"><IMG SRC="<?=TEMPLATE_PATH?>images/spacer.gif" WIDTH="11" HEIGHT="1" BORDER="0" ALT=" "></TD>
		</TR>
		</TABLE>
	</TD>
	<TD WIDTH="100%">
		<!-- BEGIN BLOCK: Содержательная часть -->
		<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0">
		<!-- BEGIN BLOCK: Навигация второстепенной значимости -->
		<TR BGCOLOR="#D3DBDF">
			<TD WIDTH="9"><IMG SRC="<?=TEMPLATE_PATH?>images/spacer.gif" WIDTH="9" HEIGHT="23" BORDER="0" ALT=" "></TD>
			<TD COLSPAN="3" WIDTH="100%">
				<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0">
				<TR VALIGN="bottom">
					<TD>
						<!-- BEGIN BLOCK: Навигация -->
						<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
						<TR>
							<TD><A HREF="#" CLASS="menu_02">Главная</A></TD>
							<TD STYLE="padding: 0px 7px 0px 7px;"><IMG SRC="<?=TEMPLATE_PATH?>images/page_div_01.gif" WIDTH="2" HEIGHT="17" BORDER="0" ALT=" "></TD>
							<TD><A HREF="#" CLASS="menu_02">Обратная связь</A></TD>
							<TD STYLE="padding: 0px 7px 0px 7px;"><IMG SRC="<?=TEMPLATE_PATH?>images/page_div_01.gif" WIDTH="2" HEIGHT="17" BORDER="0" ALT=" "></TD>
							<TD><A HREF="#" CLASS="menu_02">Карта сайта</A></TD>
							<TD STYLE="padding-left: 10px;"><IMG SRC="<?=TEMPLATE_PATH?>images/topmenu_border_01.gif" WIDTH="1" HEIGHT="17" BORDER="0" ALT=" "></TD>
							<TD CLASS="language"><IMG SRC="<?=TEMPLATE_PATH?>images/topmenu_arrow_01.gif" WIDTH="8" HEIGHT="9" BORDER="0" CLASS="language" ALT=" "><A HREF="#" CLASS="menu_02">English</A></TD>
							<TD><IMG SRC="<?=TEMPLATE_PATH?>images/topmenu_border_01.gif" WIDTH="1" HEIGHT="17" BORDER="0" ALT=" "></TD>
						</TR>
						</TABLE>
						<!-- END BLOCK: Навигация -->
					</TD>
					<TD ALIGN="right">
						<!-- BEGIN BLOCK: Календарь -->
						<TABLE WIDTH="197" BORDER="0" CELLPADDING="0" CELLSPACING="0">
						<TR>
							<TD WIDTH="1"><IMG SRC="<?=TEMPLATE_PATH?>images/topmenu_border_01.gif" WIDTH="1" HEIGHT="17" BORDER="0" ALT=" "></TD>
							<TD CLASS="calendar" WIDTH="195">
								<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
								<TR VALIGN="bottom">
									<TD CLASS="date_01" WIDTH="30">ДАТА:</TD>
									<TD CLASS="date_02" WIDTH="151" ALIGN="right"><SPAN CLASS="date_03"><?=date('d')?></SPAN> <?=strtoupper(date('F'))?>, <?=strtoupper(date('l'))?></TD>
								</TR>
								<TR>
									<TD></TD>
									<TD ALIGN="right"><IMG SRC="<?=TEMPLATE_PATH?>images/calendar_underline.gif" WIDTH="151" HEIGHT="1" BORDER="0" ALT=" "></TD>
								</TR>
								</TABLE>
							</TD>
							<TD WIDTH="1"><IMG SRC="<?=TEMPLATE_PATH?>images/topmenu_border_01.gif" WIDTH="1" HEIGHT="17" BORDER="0" ALT=" "></TD>
						</TR>
						</TABLE>
						<!-- END BLOCK: Календарь -->
					</TD>
				</TR>
				</TABLE>
			</TD>
			<TD WIDTH="9"><IMG SRC="<?=TEMPLATE_PATH?>images/spacer.gif" WIDTH="9" HEIGHT="23" BORDER="0" ALT=" "></TD>
		</TR>
		<!-- END BLOCK: Навигация второстепенной значимости -->
		<!-- BEGIN BLOCK: Верх шапки -->
		<TR>
			<TD BGCOLOR="#D3DBDF" WIDTH="9"><IMG SRC="<?=TEMPLATE_PATH?>images/head_corner_01.gif" WIDTH="9" HEIGHT="9" BORDER="0" ALT=" "></TD>
			<TD CLASS="head_border_03" COLSPAN="3" WIDTH="100%"><IMG SRC="<?=TEMPLATE_PATH?>images/spacer.gif" WIDTH="1" HEIGHT="9" BORDER="0" ALT=" "></TD>
			<TD BGCOLOR="#D3DBDF" WIDTH="9"><IMG SRC="<?=TEMPLATE_PATH?>images/head_corner_02.gif" WIDTH="9" HEIGHT="9" BORDER="0" ALT=" "></TD>
		</TR>
		<!-- END BLOCK: Верх шапки -->
		<!-- BEGIN BLOCK: Шапка -->
		<TR>
			<TD CLASS="content_border_01" WIDTH="9"><IMG SRC="<?=TEMPLATE_PATH?>images/spacer.gif" WIDTH="9" HEIGHT="1" BORDER="0" ALT=" "></TD>
			<TD CLASS="head_backgr_01" COLSPAN="3" WIDTH="100%">
				<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0">
					<TR>
						<TD><a href="/"><IMG SRC="<?=TEMPLATE_PATH?>images/head_img_01.jpg" WIDTH="313" BORDER="0" ALT="Единая система информации об обстановке в Мировом океане. Подпрограмма 10. Федеральная целевая программа &laquo;Мировой океан&raquo;."></a><a href="http://mk.esimo.ru" target="_blank"><IMG SRC="<?=TEMPLATE_PATH?>images/mk.png" BORDER="0" ALT="Морская Коллегия при Правительстве Российской Федерации"></a></TD>
						<TD ALIGN="right">
							<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
							<TR>
								<TD><IMG SRC="<?=TEMPLATE_PATH?>images/head_img_02.jpg" WIDTH="199" HEIGHT="112" BORDER="0" ALT=" "></TD>
								<!-- BEGIN BLOCK: Картинка региона или АРМа -->
								<TD><IMG SRC="<?=TEMPLATE_PATH?>images/head_img_03.jpg" WIDTH="192" HEIGHT="112" BORDER="0" ALT="Картинка региона или АРМа"></TD>
								<!-- END BLOCK: Картинка региона или АРМа -->
								<TD><IMG SRC="<?=TEMPLATE_PATH?>images/head_img_04.jpg" WIDTH="30" HEIGHT="112" BORDER="0" ALT=" "></TD>
								<TD>
									<!-- BEGIN BLOCK: Логин -->
									<TABLE HEIGHT="112" BORDER="0" CELLPADDING="0" CELLSPACING="0">
									<TR>
										<TD HEIGHT="4"><IMG SRC="<?=TEMPLATE_PATH?>images/head_img_05.jpg" WIDTH="193" HEIGHT="4" BORDER="0" ALT=" "></TD>
									</TR>
									<TR>
										<TD CLASS="login_form" HEIGHT="100%" VALIGN="top">
<? $PAGE->IncludeModule('authorization');?>
										</TD>
									</TR>
									<TR>
										<TD HEIGHT="4"><IMG SRC="<?=TEMPLATE_PATH?>images/head_img_06.jpg" WIDTH="193" HEIGHT="4" BORDER="0" ALT=" "></TD>
									</TR>
									</TABLE>
									<!-- END BLOCK: Логин -->
								</TD>
								<TD><IMG SRC="<?=TEMPLATE_PATH?>images/head_img_07.jpg" WIDTH="4" HEIGHT="112" BORDER="0" ALT=" "></TD>
							</TR>
							</TABLE>
						</TD>
					</TR>
				</TABLE>
			</TD>
			<TD CLASS="content_border_02" WIDTH="9"><IMG SRC="<?=TEMPLATE_PATH?>images/spacer.gif" WIDTH="9" HEIGHT="1" BORDER="0" ALT=" "></TD>
		</TR>
		<!-- END BLOCK: Шапка -->
		<!-- BEGIN BLOCK: Меню -->
		<TR>
			<TD CLASS="content_border_01" WIDTH="9"><IMG SRC="<?=TEMPLATE_PATH?>images/spacer.gif" WIDTH="9" HEIGHT="1" BORDER="0" ALT=" "></TD>
			<TD CLASS="menu_backgr_01" COLSPAN="3" VALIGN="bottom" WIDTH="100%">
<?$PAGE->IncludeMenu('top', array('LEVEL'=>1, 'LEVEL_LENGTH'=>1))?>
			</TD>
			<TD CLASS="content_border_02" WIDTH="9"><IMG SRC="<?=TEMPLATE_PATH?>images/spacer.gif" WIDTH="9" HEIGHT="1" BORDER="0" ALT=" "></TD>
		</TR>
		<!-- END BLOCK: Меню -->
		<!-- BEGIN BLOCK: Верх основного контента -->
		<TR>
			<TD CLASS="content_border_01" WIDTH="9"><IMG SRC="<?=TEMPLATE_PATH?>images/spacer.gif" WIDTH="9" HEIGHT="1" BORDER="0" ALT=" "></TD>
			<TD CLASS="content_top_02" COLSPAN="3" WIDTH="100%"><IMG SRC="<?=TEMPLATE_PATH?>images/spacer.gif" WIDTH="1" HEIGHT="7" BORDER="0" ALT=" "></TD>
			<TD CLASS="content_border_02" WIDTH="9"><IMG SRC="<?=TEMPLATE_PATH?>images/spacer.gif" WIDTH="9" HEIGHT="1" BORDER="0" ALT=" "></TD>
		</TR>
		<!-- END BLOCK: Верх основного контента -->
		<!-- BEGIN BLOCK: Основной контент -->
		<TR>
			<TD CLASS="content_border_01" WIDTH="9"><IMG SRC="<?=TEMPLATE_PATH?>images/spacer.gif" WIDTH="9" HEIGHT="1" BORDER="0" ALT=" "></TD>
			<TD BGCOLOR="#4F839B" WIDTH="1"><IMG SRC="<?=TEMPLATE_PATH?>images/spacer.gif" WIDTH="1" HEIGHT="1" BORDER="0" ALT=" "></TD>
			<TD CLASS="content_backgr_01" WIDTH="100%">
				<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="3">
				<TR VALIGN="top">
					<TD CLASS="column_01" WIDTH="190">
						<!-- BEGIN BLOCK: Левое подменю -->
						<TABLE WIDTH="180" BORDER="0" CELLPADDING="0" CELLSPACING="0" CLASS="submenu_frame_01">
						<TR>
							<TD ALIGN="center">
								<!-- BEGIN BLOCK: Активное (текущее) меню 2-го уровня -->
								<TABLE WIDTH="178" BORDER="0" CELLPADDING="0" CELLSPACING="0">
								<TR>
									<TD><IMG SRC="<?=TEMPLATE_PATH?>images/submenu_corner_01.gif" WIDTH="3" HEIGHT="3" BORDER="0" ALT=" "></TD>
									<TD><IMG SRC="<?=TEMPLATE_PATH?>images/submenu_border_backgr_03.gif" WIDTH="172" HEIGHT="3" BORDER="0" ALT=" "></TD>
									<TD><IMG SRC="<?=TEMPLATE_PATH?>images/submenu_corner_02.gif" WIDTH="3" HEIGHT="3" BORDER="0" ALT=" "></TD>
								</TR>
								<TR VALIGN="top">
									<TD class="table_bg"><BR></TD>
									<TD CLASS="submenu_frame_03">
<? $PAGE->IncludeMenu('left', array('LEVEL'=>2, 'LEVEL_LENGTH'=>0, 'TYPE' => 'BRANCH'))?>
									</TD>
									<TD class="table_bg"><BR></TD>
								</TR>
								<TR>
									<TD><IMG SRC="<?=TEMPLATE_PATH?>images/submenu_corner_03.gif" WIDTH="3" HEIGHT="3" BORDER="0" ALT=" "></TD>
									<TD><IMG SRC="<?=TEMPLATE_PATH?>images/submenu_border_backgr_04.gif" WIDTH="172" HEIGHT="3" BORDER="0" ALT=" "></TD>
									<TD><IMG SRC="<?=TEMPLATE_PATH?>images/submenu_corner_04.gif" WIDTH="3" HEIGHT="3" BORDER="0" ALT=" "></TD>
								</TR>
								</TABLE>
								<!-- END BLOCK: Активное (текущее) меню 2-го уровня -->

							</TD>
						</TR>
						</TABLE>
						<!-- END BLOCK: Левое подменю -->
					</TD>
					<TD CLASS="column_02" WIDTH="100%">
						<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0">
						<TR>
							<TD HEIGHT="56" VALIGN="top" WIDTH="100%">
								<!-- BEGIN BLOCK: Путь юзера -->
								<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" CLASS="path">
								<TR VALIGN="top">
									<TD CLASS="path"><A HREF="http://www.oceaninfo.ru" CLASS="domain">www.oceaninfo.ru</A></TD>
									<TD CLASS="path_div"></TD>
									<TD CLASS="path">
<? $PAGE->includeBreadCrumbs()?>
									</TD>
								</TR>
								</TABLE>
								<!-- END BLOCK: Путь юзера -->
							</TD>
							<TD VALIGN="top" STYLE="padding-bottom:4px;" WIDTH="190">
								<!-- BEGIN BLOCK: Поиск --
								<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="4" CLASS="submenu_frame_02">
								<TR VALIGN="top">
									<TD CLASS="search_frame_01" HEIGHT="42">
										<FORM ACTION="#" METHOD="post" NAME="search_form_01" ID="search_form_01" CLASS="search_form">
										<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
										<TR>
											<TD WIDTH="118"><INPUT TYPE="text" NAME="search_query" VALUE=" Поисковый запрос" CLASS="input_text" STYLE="width: 118px; height: 20 px;"></TD>
											<TD ALIGN="right" STYLE="padding-left: 2px;" WIDTH="50"><A HREF="#" onMouseOver="ChangeImg('search_01','search_01_over')" onMouseOut="ChangeImg('search_01','search_01_out')" onClick="document.forms['search_form_01'].submit(); return true;"><IMG SRC="<?=TEMPLATE_PATH?>images/search_btn_01.gif" WIDTH="48" HEIGHT="24" BORDER="0" ID="search_01" NAME="search_01" ALT="Найти"></A></TD>
										</TR>
										</TABLE>
										</FORM>
									</TD>
								</TR>
								</TABLE>
								<!-- END BLOCK: Поиск -->
							</TD>
						</TR>
						<TR>
							<TD COLSPAN="2" STYLE="padding-right: 4px;" VALIGN="top">
								<!-- BEGIN BLOCK: Центральная колонка -->
								<TABLE WIDTH="100%" BORDER="0" CELLPADDING="0" CELLSPACING="0" CLASS="content_frame_01">
								<TR VALIGN="top">
									<TD CLASS="main_content">
										<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" CLASS="main_title_02">
										<TR VALIGN="top">
											<TD><IMG SRC="<?=TEMPLATE_PATH?>images/arrow_main_title.gif" WIDTH="11" HEIGHT="9" BORDER="0" CLASS="main_title_02" ALT=" "></TD>
											<TD><A HREF="#" CLASS="main_title_02"><?php echo $PAGE->getSectionTitle()?></A></TD>
										</TR>
										</TABLE>
										<SPAN CLASS="main_title_01"><?php echo $PAGE->getPageTitle()?></SPAN>
										<HR CLASS="title_underline">
