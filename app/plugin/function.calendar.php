<?php
function smarty_function_calendar($params, &$smarty) {
	$value = '';
	if (! empty ( $params ['value'] ))
		$value = substr ( $params ['value'], 0, 10 );
	if (empty ( $value ))
		$value = date ( 'Y-m-d' );
	return "<script>
			var c = new Calendar('c');
			document.write(c);
			</script>
			<input type='text' name='{$params['name']}' readonly='readonly' value='{$value}'  onfocus='c.showMoreDay = false;c.show(this);'/>";
}
?>