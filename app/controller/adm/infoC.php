<?php
class controller_adm_infoC extends controller_adm {
	
	function __construct() {
		parent::__construct ();
		$this->dao = m ( 'info' );
		$this->assign ( 'ic', m ( 'infoCate' )->find ( $_REQUEST ['ic_id'] ) );
	}
	
	function actionIndex() {
		$array = array ();
		$array ['ic_id'] = $_REQUEST ['ic_id'];
		if (! empty ( $_REQUEST ['seaname'] ))
			array_push ( $array, array ('name', "%{$_REQUEST ['seaname']}%", 'like' ) );
		
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
			js_alert ( '名称不能为空，并且不能超过255字符', lastUrl () );
		else {
			if (! empty ( $_POST ['id'] ))
				$ob = $this->dao->find ( $_POST ['id'] );
			$ob ['ic_id'] = ( int ) $_REQUEST ['ic_id'];
			$ob ['name'] = h ( $_POST ['name'] );
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
}
?>