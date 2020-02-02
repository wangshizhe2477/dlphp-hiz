<?php
class controller_adm_photo extends controller_adm {
	
	function __construct() {
		parent::__construct ();
	}
	
	function actionIndex() {
		$this->_pager ( $this->dao, null, 'createtime desc' );
		$this->_view ();
	}
	function actionToEdit() {
		if (! empty ( $_REQUEST ['id'] ))
			$this->assign ( 'ob', $this->dao->find ( $_REQUEST ['id'] ) );
		$this->_view ();
	}
	function actionEdit() {
		if (empty ( $_POST ['pc_id'] ))
			js_alert ( '类别不能为空', lastUrl () );
		else {
			if (! empty ( $_POST ['id'] ))
				$ob = $this->dao->find ( $_POST ['id'] );
			$ob ['pc_id'] = $_POST ['pc_id'];
			$ob ['photo'] = upload_photo ( $ob ['photo'] );
			$ob ['name'] = h ( $_POST ['name'] );
			$ob ['fun'] = clear_js ( $_POST ['fun'] );
			$ob ['other'] = clear_js ( $_POST ['other'] );
			cScript ( $_POST ['lastUrl'], $this->dao->save ( $ob ), '编辑' );
		}
	}
	function actionDel() {
		$this->delete ();
	}
	//----------AJAX----------
	function actionSort() {
		$this->sort ();
	}
	function actionUp() {
		$this->logic ();
	}
}
?>
