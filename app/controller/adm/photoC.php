<?php
class controller_adm_photoC extends controller_adm {
	
	var $parameter;
	
	function __construct() {
		parent::__construct ();
		$this->dao = m ( 'photo' );
		$this->assign ( 'pc', m ( 'photoCate' )->find ( $_REQUEST ['pc_id'] ) );
	}
	
	function actionIndex() {
		$this->_pager ( $this->dao, array ('pc_id' => $_REQUEST ['pc_id'] ), 'createtime desc' );
		$this->_view ();
	}
	function actionToEdit() {
		if (! empty ( $_REQUEST ['id'] ))
			$this->assign ( 'ob', $this->dao->find ( $_REQUEST ['id'] ) );
		$this->_view ();
	}
	function actionEdit() {
		if (empty ( $_POST ['name'] ) || strlen ( $_POST ['name'] ) > 255)
			js_alert ( '名称不能为空，并且不能超过255字符', lastUrl () );
		else {
			if (! empty ( $_POST ['id'] ))
				$ob = $this->dao->find ( $_POST ['id'] );
			$ob ['pc_id'] = $_REQUEST ['pc_id'];
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