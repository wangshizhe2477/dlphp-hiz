<?php
/**
 * photoCate表查询
 */
function smarty_modifier_photo_cate($pc_id = null) {
	if (empty ( $pc_id ))
		return m ( 'photoCate' )->findSuper ();
	else
		return m ( 'photoCate' )->findAll ( array ('pid' => $pc_id ), 'sort_order' );
}
?>