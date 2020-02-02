<?php
class controller_common extends controller {
	
	function __construct() {
		parent::__construct ();
	}
	
	//生成随即验证码
	function actionImgcode() {
		$imgcode = FLEA::getSingleton ( 'FLEA_Helper_ImgCode' );
		$imgcode->image ();
	}
	
	/**
	 * jtip显示通用调用图片
	 */
	function actionJipImg() {
		echo "<img src='{$_GET['path']}?r=" . rand ( 100, 999 ) . "' width='225'/>";
	}
}
?>