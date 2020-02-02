<?php
/**
 * 会员后台提示模块
 */
function smarty_block_user_tip($params, $content, &$smarty) {

	$str = '<div class="point" id="announcement">';
	$str .= '<a onclick="$(\'#announcement\').hide();" class="close"><span>关闭</span></a>';
	$str .= '<div class="content">';
	$str .= $content;
	$str .= '</div>';
	$str .= '</div>';
	return $str;
}
?>
