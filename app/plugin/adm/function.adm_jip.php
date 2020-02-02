<?php
/**
 * 后台图片显示
 */
function smarty_function_adm_jip($params, &$smarty) {
	$path = $params ['path'];
	if (! $params ['cusDir'])
		$path = BASEURL . 'upload/' . $path;
	return "<a href='index.php?c=common&a=jipImg&path=" . urlencode($path) . "' name='查看图片' id='p" . rand ( 1, 999999 ) . "' class='jTip'><img src='img/adm/icon_pic.gif'/></a>";
}
?>