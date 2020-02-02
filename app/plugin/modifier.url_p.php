<?php
/**
 * urlP表查询
 * 图片友情链接
 */
function smarty_modifier_url_p($limit) {
	return m ( 'urlP' )->findAll ( null, 'sort_order', $limit );
}
?>