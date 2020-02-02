<?php
class controller_adm_job extends controller_adm {
	
	function __construct() {
		parent::__construct ();
	}
	
	function actionIndex() {
		$this->_pager ( $this->dao );
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
			$ob ['name'] = h ( $_POST ['name'] );
			$ob ['number'] = h ( $_POST ['number'] );
			$ob ['educ'] = h ( $_POST ['educ'] );
			$ob ['job'] = h ( $_POST ['job'] );
			$ob ['sex'] = h ( $_POST ['sex'] );
			$ob ['money'] = h ( $_POST ['money'] );
			$ob ['other'] = h ( $_POST ['other'] );
			$ob ['endtime'] = h ( $_POST ['endtime'] );
			cScript ( $_POST ['lastUrl'], $this->dao->save ( $ob ), '编辑' );
		}
	}
	function actionDel() {
		$this->delete ();
	}
}
?>