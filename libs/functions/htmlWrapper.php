<?
class htmlWrapper {

	public static function getSelectSimple($arFields, $name, $id='', $jsFunctions = '', $selected = 0){
		$output = "<select class='input_text'  name='{$name}' id='{$id}' {$jsFunctions}>";
		$output .= "<option value=''>";
		foreach ($arFields as $item) {
			$output .= "<option value='{$item['id']}' ".( ($selected == $item['id']) ? 'selected' : '').">{$item['name']}";
		}
		$output .= "</select>";
		return $output;
	}
}
?>