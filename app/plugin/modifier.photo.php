<?php
/**
 * 图文推荐
 * @param $limit 0->不限数量
 * @return array photo
 */
function smarty_modifier_photo($limit = 0) {
	$desc = 'sort_order';
	$para = array ('up' => 1 );
	if ($limit != 0)
		return m ( 'photo' )->findAll ( $para, $desc, $limit );
	else
		return m ( 'photo' )->findAll ( $para, $desc );
}
?>
