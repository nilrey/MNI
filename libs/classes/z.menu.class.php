<?php
class CMenu {
	private $arMenu = array();
	private $selectedItem = array();
	private $max_level = 0;
	
	function __construct($pathMenu){
		if(!is_file($pathMenu)){
			return false;
		}
		include_once($pathMenu);
		$this->arMenu = $arMenu;
	}
	
	function getMenu(){
		return $this->arMenu;
	}
	
	function getSelectedItem(){
		return $this->selectedItem;
	}
	
	function prepareMenu(){
		$START_FROM_LEVEL=1;
		$current_branch_start = 0;
		$length = 1;
		$branch_max_level = 1;
		$doExit = false;
		$arMenu = &$this->arMenu;
		if(count($arMenu) < 1){
			return false;
		}
		foreach ($arMenu as $key=> &$arItem){ // ---------------------------------------------------------------------------------------------
			// поиск всех выделенных звеньев меню
			if($key>0){
				if($arMenu[$key-1]['level'] < $arItem['level']){
					if(!$doExit){
	//							$arMenu[$key-1]['selected'] = true;
						$arBranchSelected[$arMenu[$key-1]['level']] = $key-1;
					}
					$arMenu[$key-1]['parent'] = 'Y';
				}
				if ($arMenu[$key-1]['level'] > $arItem['level']){
						$arMenu[$key-1]['last_item'] = 'Y';
				}
			}
			
			if($doExit){
				// после сбора всей цепочки и дойдя до след. элемента.level == START_FROM_LEVEL
				break; // break foreach
			}
			if ( in_array( strtolower($_SERVER['REQUEST_URI'] ), $arItem['url'] ) )  {
				$arItem['selected'] = true;
				$doExit = true;
			}
		}	// ---------------------------------------------------------------------------------------------------------------------------------
		
		if($current_branch_start !== false){
			$arMenu = array_slice($arMenu, $current_branch_start, $length);
		}
		// selected nodes of the menu
		foreach ($arBranchSelected as $selected_item){
			$arMenu[$selected_item]['selected'] = true;
		}
		$arMenu[0]['max_level'] = $branch_max_level;
		$arMenu[count($arMenu)-1]['last_item'] = 'Y';
		
		return true;
	}
}
?>