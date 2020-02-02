<?php
function smarty_function_adm_del($params, &$smarty) {
	$id = $params ['id'];
	$url = url($_REQUEST['c'], 'del', array('id' => $id));
	return "<img src='img/adm/icon_drop.gif' onclick=\"isDel('{$url}')\"/>";
}
?>