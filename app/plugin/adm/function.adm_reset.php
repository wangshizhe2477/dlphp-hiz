<?php
function smarty_function_adm_reset($params, &$smarty) {
	if (empty ( $params ['value'] ))
		$params ['value'] = '重置';
	return "<input type='reset' value=' {$params['value']} ' class='btn1'/>";
}
?>