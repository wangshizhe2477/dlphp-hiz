<?php
function smarty_modifier_dimg($dc_id, $limit) {
	$para = array ();
	if (! empty ( $dc_id ))
		$para ['dc_id'] = $dc_id;
	return m ( 'dimg' )->findAll ( $para, 'sort_order', $limit );
}
?>