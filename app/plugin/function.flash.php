<?php
function smarty_function_flash($params, &$smarty) {
	return "<embed src='swf/{$params['name']}.swf' type='application/x-shockwave-flash' quality='high' wmode='transparent' width='{$params['width']}px' height='{$params['height']}px'/>";
}
?>