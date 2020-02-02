<?php
/** 
 * @para $separator 分隔符
 */
function smarty_modifier_string_to_array($str, $separator) {
	return explode($separator, $str);
}
?>