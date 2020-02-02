<?php
/**
 * 图文推荐
 * @param $limit 0->不限数量
 * @return photo Array
 */
function smarty_modifier_example($ec_id, $limit = 0) {
	$desc = 'sort_order';
	$para = array ();
	if (! empty ( $ec_id ))
		$para ['ec_id'] = $ec_id;
	if ($limit != 0)
		return m ( 'example' )->findAll ( $para, $desc, $limit );
	else
		return m ( 'example' )->findAll ( $para, $desc );
}
?>