<?php
/**
 * 新闻列表
 * @return info Array
 */
function smarty_modifier_info($ic_id, $limit) {
	$array = array ();
	$desc = 'sort_order';
	if (! empty ( $ic_id ))
		$array ['ic_id'] = $ic_id;
	if (! empty ( $limit ))
		return m ( 'info' )->findAll ( $array, $desc, $limit );
	else
		return m ( 'info' )->findAll ( $array, $desc );
}
?>
