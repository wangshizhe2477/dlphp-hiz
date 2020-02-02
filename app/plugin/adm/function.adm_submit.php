<?php
function smarty_function_adm_submit($params, &$smarty) {
	if (empty ( $params ['value'] ))
		$params ['value'] = '提交';
	return "<input type='submit' value=' {$params['value']} ' class='btn1'/>";
}
?>