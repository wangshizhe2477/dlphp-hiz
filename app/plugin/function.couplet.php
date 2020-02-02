<?php
/**
 * 对联
 */
function smarty_function_couplet($params, &$smarty) {
	$height = empty($params['height']) ? 370 : $params['height'];
	$width = empty($params['width']) ? 100 : $params['width'];
	return '<div id="floatbox_left">
	<div><img src="' . $params['left_img'] . '"/></div>
	<div class="floatbox_c"><a onclick="$(\'#floatbox_left\').hide();">关闭</a></div>
	</div>
	
	<div id="floatbox_right">
	<div><img src="' . $params['right_img'] . '"/></div>
	<div class="floatbox_c"><a onclick="$(\'#floatbox_right\').hide();">关闭</a></div>
	</div>
	
	<style>
	/*******左浮动*******/
	#floatbox_left{z-index:10;position:absolute; left:7px;top: 580px;}
	#floatbox_left img{display:block;width:' . $width . 'px;height:' . $height . 'px;}
	/*******右浮动*******/
	#floatbox_right{z-index:10;position:absolute; right:7px;top: 580px;}
	#floatbox_right img{display:block;width:' . $width . 'px;height:' . $height . 'px;}
	.floatbox_c{height: 18px;background: #666;text-align: right;line-height: 18px;width:100px;}
	.floatbox_c a{cursor: pointer;margin-right: 7px;}
	</style>
	<script src="js/couplet.js" type="text/javascript"></script>';
}
?>