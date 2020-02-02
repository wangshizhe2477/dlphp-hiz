<?php
/**
 * url表查询
 * @param $uc_id 类型
 */
function smarty_modifier_url($uc_id) {
	return m ( 'url' )->findAll ( array ('uc_id' => $uc_id ), 'sort_order' );
}
?>