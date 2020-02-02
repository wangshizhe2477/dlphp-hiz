<?php
/** 
 * @returnDefault 是否返回默认图片 如果false则返回''
 */
function smarty_modifier_pic_show($photo, $returnDefault = true) {
	$file = 'upload/' . $photo;
	if (file_exists ( $file ) && !empty($photo))
		return $file;
	if($returnDefault)
		return 'img/sys/nopict.gif';
	return '';
}
?>