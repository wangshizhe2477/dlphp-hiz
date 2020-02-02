<?php
/**
 * 传递一个来路URL
 */
function smarty_function_inputlasturl($params, &$smarty) {
	return "<input type='hidden' id='lastUrl' name='lastUrl'/>
		<script>$('#lastUrl').val(self.document.referrer);</script>";
}
?>