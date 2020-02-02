<?php
class controller_adm_info extends controller_adm {
	
	function __construct() {
		parent::__construct ();
	}
	
	function actionIndex() {
		$array = array ();
		if (! empty ( $_REQUEST ['seaname'] ))
			array_push ( $array, array ("name", "%" . $_REQUEST ['seaname'] . "%", "like" ) );
		$this->_pager ( $this->dao, $array, 'createtime desc' );
		$this->_view ();
	}
	
	function actionToEdit() {
		if (! empty ( $_REQUEST ['id'] ))
			$this->assign ( 'ob', $this->dao->find ( $_REQUEST ['id'] ) );
		$this->_view ();
	}
	function actionEdit() {
		if (empty ( $_POST ['name'] ) || strlen ( $_POST ['name'] ) > 255)
			js_alert ( '名称不能为空，并且不能超过60字符', lastUrl () );
		else {
			if (! empty ( $_POST ['id'] ))
				$ob = $this->dao->find ( $_POST ['id'] );
			$ob ['name'] = h ( $_POST ['name'] );
			$ob ['other'] = clear_js ( $_POST ['other'] );
			$ob ['ic_id'] = ( int ) $_POST ['ic_id'];
			cScript ( $_POST ['lastUrl'], $this->dao->save ( $ob ), '编辑' );
		}
	}
	function actionDel() {
		$this->delete();
	}
	//----------AJAX----------
	function actionSort() {
		$this->sort ();
	}
}
?>