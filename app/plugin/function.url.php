<?php
//提供对 FleaPHP url() 函数的支持
function smarty_function_url($params, &$smarty) {
	$controllerName = isset ( $params ['c'] ) ? $params ['c'] : null;
	unset ( $params ['c'] );
	$actionName = isset ( $params ['a'] ) ? $params ['a'] : null;
	unset ( $params ['a'] );
	$anchor = isset ( $params ['anchor'] ) ? $params ['anchor'] : null;
	unset ( $params ['anchor'] );
	$options = array ('bootstrap' => isset ( $params ['bootstrap'] ) ? $params ['bootstrap'] : null );
	unset ( $params ['bootstrap'] );
	$args = array ();
	foreach ( $params as $key => $value ) {
		if (is_array ( $value )) {
			$args = array_merge ( $args, $value );
			unset ( $params [$key] );
		}
	}
	$args = array_merge ( $args, $params );
	return url ( $controllerName, $actionName, $args, $anchor, $options );
}
?>