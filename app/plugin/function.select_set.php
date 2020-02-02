<?php
/**
 * 设置select默认值
 * $name select的name
 * $value 值
 */
function smarty_function_select_set($params, &$smarty) {
	return "<script>$(\"select[name='{$params['name']}'] option[value='{$params['value']}']\").attr('selected', true);</script>";
}
?>