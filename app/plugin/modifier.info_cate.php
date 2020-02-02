<?php
function smarty_modifier_info_cate() {
	return m ( 'infoCate' )->findAll(null, 'sort_order');
}
?>
