<?php
/**
 * 排序
 * @param $id
 * @param $value
 */
function smarty_function_adm_sort($params, &$smarty) {
	return "<input title='数越大排名越靠前' type='text' style='width:30px;' value='{$params['value']}' onchange=\"admSort(this, {$params['id']})\"/>";
}
?>