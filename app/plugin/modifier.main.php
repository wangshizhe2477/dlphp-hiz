<?php
/**
 * 控制main表查询
 * 根据ID返回详细信息
 */
function smarty_modifier_main($id, $field = null) {
	if (empty ( $id ))
		return;
	$ob = m ( 'main' )->find ( $id );
	if (! empty ( $field ))
		return $ob [$field];
	return $ob;
}
?>