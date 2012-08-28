<?php
class CPage {
	// CPage Url params
	private $pageUrl = '';
	private $basePageUrl = '';
	private $urlParams = array();
	var $arOutput = array();
	var $isMenuEmpty = false;
	var $isMenuPrepeared = false;
	var $selectedMenuItem = array();
	var $arBreadCrumbs = array();
	
	// CPage page attributes
	var $pageTitle = '';
	var $sectionTitle = '';
	var $allowedGroups = array();
	private $USER = object;

	public function __construct(){
		$this->pageUrl = strtolower($_SERVER['REQUEST_URI']);
		$this->basePageUrl = substr($this->pageUrl, 0, intval(strpos($this->pageUrl , '?')) ) ;
	}
	
	function setUserParams($value){
		$this->USER = $value;
	}
	function getUserParams(){
		return $this->USER;
	}
	// CPage template params
	private $templateMain = '';
	var $pathMainTemplate = '';

	public function setSectionTitle($value){
		$this->sectionTitle = $value;
	}
	public function getSectionTitle(){
		return $this->sectionTitle;
	}
	public function setPageTitle($value){
		$this->pageTitle = $value;
	}
	public function getPageTitle(){
		return $this->pageTitle;
	}
	function setPathMainTemplate($value){
		$this->pathMainTemplate = $value;
	}
	function getPathMainTemplate(){
		return $this->pathMainTemplate;
	}
	function setTemplateMain($value){
		$this->templateMain = $value;
	}
	function getTemplateMain(){
		return $this->templateMain;
	}
	
	function getPageUrl(){
		return $this->pageUrl;
	}
	
	function getBasePageUrl(){
		return $this->basePageUrl;
	}
	
	function setUrlParams($arValues){
		$this->urlParams = array();
	}
	function getUrlParams(){
		return $this->urlParams;
	}
	
	function setOutput($output){
		array_push($this->arOutput, $output);
	}
	function getOutput(){
		return $this->arOutput;
	}
	function IncludeComponentModel($component_name, &$arResult, &$arParams, &$PAGE, &$USER){
		if(is_file($_SERVER['DOCUMENT_ROOT'].'/components/'.$component_name.'/functions.php')){
			include($_SERVER['DOCUMENT_ROOT'].'/components/'.$component_name.'/functions.php');
		}
		
		include($_SERVER['DOCUMENT_ROOT'].'/components/'.$component_name.'/component.php');
	}
	function IncludeComponentTemplate($component_name, &$arResult, &$arParams, &$PAGE, &$USER){
		if(empty($arParams['template'])) $arParams['template'] = 'template';
		include($_SERVER['DOCUMENT_ROOT'].'/components/'.$component_name.'/tpl/'.$arParams['template'].'.php');
	}
	
	function IncludeComponent($component_name, $arParams = array()){
		if(outputHandlerOn()){
			outputHandlerCut(&$this->arOutput);
			$arResult = array();
			$PAGE = $this;
			global $USER;
			$this->IncludeComponentModel($component_name, &$arResult, &$arParams, &$PAGE, &$USER);
			$this->IncludeComponentTemplate($component_name, &$arResult, &$arParams, &$PAGE, &$USER);
			outputHandlerCut(&$this->arOutput, 'COMPONENT');
		}
	}	
	
	function IncludeModuleModel($module_name, &$arResult, &$arParams, &$PAGE, &$USER){
		include($_SERVER['DOCUMENT_ROOT'].'/modules/'.$module_name.'/module.php');
	}
	function IncludeModuleTemplate($module_name, &$arResult, &$arParams, &$PAGE, &$USER){
		include($_SERVER['DOCUMENT_ROOT'].'/modules/'.$module_name.'/tpl/template.php');
	}

	function IncludeModule($module_name, &$arParams = array()){
			$arResult = array();
			$PAGE = $this;
			global $USER;
			$this->IncludeModuleModel($module_name, &$arResult, &$arParams, &$PAGE, &$USER);
			$this->IncludeModuleTemplate($module_name, &$arResult, &$arParams, &$PAGE, &$USER);
	}	
	
	function prepareMenu(){
		global $USER;
		/*
Подготовка меню.
1. подключить главный файл меню.
2. обойти массив и обозначить выделенный элемент, родительские подпункты, проверить пункты меню на доступ
		*/
		if(!is_file($_SERVER['DOCUMENT_ROOT'].'/menu.php')){
			// LOG NOTICE
			var_dump('File menu.php not found.');
//			$this->isMenuEmpty = true;
			return false;
		}
		
		include($_SERVER['DOCUMENT_ROOT'].'/menu.php'); // plug in array of Menu Items
		if(count($arMenu) < 1){
//			$this->isMenuEmpty = true;
			return false;
		}
		// Проверка на доступность страницы для данного пользователя
		foreach ($arMenu as $key=> $arItem){ 
			if( count(array_intersect($arItem['granted_groups'], $USER->getGroups())) == 0 && !$USER->isAdmin()){
				continue;
			}
			$arTmpMenu[] = $arItem;
		}
		$arMenu  = $arTmpMenu;
		
		//echo '<pre>';print_r($arMenu);echo '</pre>';
		
		$isBranchSelected = false;
		foreach ($arMenu as $key=> &$arItem){ // ---------------------------------------------------------------------------------------------
				// поиск всех выделенных звеньев меню
				
				if( !$isBranchSelected && 1 == $arItem['level']){ /// если в предыдущей ветви небыло selected елемента, обнуляем выделенные элементы ветки
					$arBranchSelected = array();
				}
				if($key > 0 ){
					if( $arMenu[$key-1]['level'] < $arItem['level']){ // если текущий уровнь больше предыдущего , предыдущий = родительский
						if(!$isBranchSelected){ // если selected елемент еще не найден, значит это узел , который может быть родительским, и его нужо включить в "хлебные крошки"
							$arBranchSelected[$arMenu[$key-1]['level']] = $key-1;
						}
						$arMenu[$key-1]['parent'] = 'Y';
						
					}else	if ( $arMenu[$key-1]['level'] > $arItem['level']){ // если текущий уровнь меньше предыдущего , текущий = последний
						$arMenu[$key-1]['last_item'] = 'Y';
						if(!$isBranchSelected){ // если selected елемент еще не найден, значит это узел , который может быть родительским, и его нужо включить в "хлебные крошки"
							$arBranchSelected[$arMenu[$key]['level']] = $key;
						}
					}else{
						$arMenu[$key-1]['last_item'] = 'N';
						if(!$isBranchSelected){ // если selected елемент еще не найден, значит это узел , который может быть родительским, и его нужо включить в "хлебные крошки"
							$arBranchSelected[$arMenu[$key]['level']] = $key;
						}
					}
				}
				
				// проверяем если элемент selected
				if(is_array($arItem['url'])){
					$ItemURL =  $this->pageUrl;
					if($arItem['use_params_to_select'] == 'N'){
//						$paramsPosition = strpos($this->pageUrl, '?');
//						if(empty($paramsPosition)) $paramsPosition = strlen($this->pageUrl);
//						if(strpos($arItem['url'][0], substr($this->pageUrl, 0, $paramsPosition ) ) !== false){
//							$this->selectedMenuItem = $arItem;
//							$this->selectedMenuItem['id'] = $key;
//							$arItem['selected'] = true;
//							$isBranchSelected = true;
//							$this->setPageTitle($arItem['name']);
//						}
						if(intval(strpos($this->pageUrl , '?')) > 0){
							$ItemURL =  substr($this->pageUrl, 0, intval(strpos($this->pageUrl , '?')) ) ;
						}
					}
					
					if ( in_array($ItemURL, $arItem['url'] ) ){
						$this->selectedMenuItem = $arItem;
						$this->selectedMenuItem['id'] = $key;
						$arItem['selected'] = true;
						$isBranchSelected = true;
						
						$tmpTitle = $this->getPageTitle();
						if(empty( $tmpTitle ) ){
							$this->setPageTitle($arItem['name']);
						}
					}
				}
			
		}	// ---------------------------------------------------------------------------------------------------------------------------------
		if(count($this->selectedMenuItem) > 0 && count($arBranchSelected) > 0){ // если сущесвует selected элемент, иначе не выделять звенья
			// selected nodes of the menu
			$arBranchSelected = array_slice($arBranchSelected, 0, $this->selectedMenuItem['level']-1);
			foreach ($arBranchSelected as $selected_item){
				$arMenu[$selected_item]['selected'] = true;
				$this->arBreadCrumbs[] = $arMenu[$selected_item]; // собрать "хлебые крошки"
			}
			$this->arBreadCrumbs[] = $this->selectedMenuItem; // собрать "хлебые крошки" , выбранный пункт меню должен стоять последним
		}
		
		
		
		$arMenu[count($arMenu)-1]['last_item'] = 'Y';
		$this->arMenu = $arMenu;
		$this->isMenuPrepeared = true;
		
		return true;
	} // END OF prepareMenu
	
	function IncludeMenu($menu_name, $arParams = array()){
		if(!$this->isMenuPrepeared){
			if(!$this->prepareMenu()){ // осуществиться только если массив Меню пуст или файл меню не подключен
				//var_dump('массив Меню пуст или файл меню не подключен');
				return false;
			}
		}
		
		if (empty($arParams['LEVEL']) ){
			$arParams['LEVEL'] = 0;
		}
		$current_branch_start = 0;
		$length = 1;
		$max_level = 1;
		$doExit = false;
		$arMenu = array();
		$arSubTitleElement = array();
		$isBranchSelected = false;
		
		if(empty($arParams['TYPE'])) $arParams['TYPE'] = '';
		
		switch ($arParams['TYPE']){
		case 'BRANCH':
				foreach ($this->arMenu as $key=> $arItem){ // ---------------------------------------------------------------------------------------------
					// поиск всех выделенных звеньев меню
					if( (1 == $arItem['level']) && !empty($arItem['selected']) ){
						$isBranchSelected = true;
					}elseif (1 == $arItem['level'] && empty($arItem['selected']) ){
						$isBranchSelected = false;
					}
					
					if($isBranchSelected){
						if($max_level < $arItem['level']) $max_level = $arItem['level'];
						$arMenu[] = $arItem;
					}
					// take parent element for subtitle	
//					if( $arItem['selected'] && ( $arItem['level'] == $arParams['LEVEL']-1 ) ){
//						$arItem['id'] = $key;
//						$arSubTitleElement[] = $arItem;
//					}
					
				}	// ---------------------------------------------------------------------------------------------------------------------------------
				
				if(count($arSubTitleElement) > 0){
					//$arMenu = array_merge($arSubTitleElement, $arMenu);
				}
		break;
		default:
			foreach ($this->arMenu as $key=> $arItem){
				if($arItem['level'] >= $arParams['LEVEL'] && 
					$arItem['level'] <= $arParams['LEVEL'] + $arParams['LEVEL_LENGTH']){
						
						$arMenu[] = $arItem;
				}
			}
		}
//				if($current_branch_start !== false){
//					$arMenu = array_slice($arMenu, $current_branch_start, $length);
//				}
		// selected nodes of the menu
		$arMenu[0]['max_level'] = $max_level;
		$arMenu[count($arMenu)-1]['last_item'] = 'Y';
		
//		ECHO '<PRE>';
//		print_r($arMenu);
//		ECHO '</PRE>';

		include($_SERVER['DOCUMENT_ROOT'].'/'.$this->pathMainTemplate.'/menu.'.$menu_name.'.php');
		
		return ;
		
	} // END OF IncludeMenu
	
	function setPageAccess($allowedGroups = array()){
		$this->allowedGroups = $allowedGroups;
	}

	function getPageAccess(){
			return $this->allowedGroups;
	}
	
	function includeBreadCrumbs(){
		$arBreadCrumbs = $this->arBreadCrumbs;
		include($_SERVER['DOCUMENT_ROOT'].'/'.$this->pathMainTemplate.'/menu.bread_crumbs.php');
		return ;
	}

} // END OF CLASS CPage
?>