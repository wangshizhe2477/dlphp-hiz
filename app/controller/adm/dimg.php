<?php
/**
 * 幻灯片图片管理
 */
class controller_adm_dimg extends controller_adm {
	
	function __construct() {
		parent::__construct ();
		$this->assign ( 'dc', m ( 'dimgCate' )->find ( $_REQUEST ['dc_id'] ) );
	}
	
	function actionIndex() {
		$this->_pager ( $this->dao, array ('dc_id' => $_REQUEST ['dc_id'] ) );
		$this->_view ();
	}
	function actionToEdit() {
		if (! empty ( $_REQUEST ['id'] ))
			$this->assign ( 'ob', $this->dao->find ( $_REQUEST ['id'] ) );
		$this->_view ();
	}
	function actionEdit() {
		if (empty ( $_POST ['name'] ))
			js_alert ( '名称不能为空', lastUrl () );
		else {
			if (! empty ( $_REQUEST ['id'] ))
				$ob = $this->dao->find ( $_REQUEST ['id'] );
			$ob ['name'] = h ( $_POST ['name'] );
			$ob ['dc_id'] = h ( $_REQUEST ['dc_id'] );
			$ob ['url'] = h ( $_POST ['url'] );
			$ob ['photo'] = upload_photo ( $ob ['photo'] );
			cScript ( $this->_url ( 'index', array ('dc_id' => $_REQUEST ['dc_id'] ) ), $this->dao->save ( $ob ), '编辑' );
		}
	}
	function actionDel() {
		$this->delete();
	}
	function actionSort() {
		$this->sort ();
	}
}
?>