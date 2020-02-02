<?php
class controller_adm_user extends controller_adm {
	
	function __construct() {
		parent::__construct ();
	}
	
	function actionIndex() {
		$this->_pager ( $this->dao, null, 'createtime desc' );
		$this->_view ();
	}
	
	function actionEditTo() {
		if (! empty ( $_GET ['id'] )) {
			$ob = $this->dao->find ( $_GET ['id'] );
			if (! empty ( $ob )) {
				$this->assign ( 'ob', $ob );
				$this->_view ();
			}
		}
	}
	
	function actionEdit() {
		if (! empty ( $_POST ['id'] )) {
			$ob = $this->dao->find ( $_POST ['id'] );
			if (! empty ( $ob )) {
				$ob ['name'] = h ( $_POST ['name'] );
				if (! empty ( $_POST ['pass'] ))
					$ob ['pass'] = encrypt ( $_POST ['pass'] );
				$ob ['mail'] = h ( $_POST ['mail'] );
				$ob ['tel'] = h ( $_POST ['tel'] );
				$ob ['addr'] = h ( $_POST ['addr'] );
				$ob ['birthday'] = h ( $_POST ['birthday'] );
				$ob ['number'] = h ( $_POST ['number'] );
				$this->dao->update ( $ob );
				js_alert ( '提交成功', $this->_url () );
			}
		}
	}
	
	function actionIslock() {
		$this->logic ();
	}
	
	function actionDel() {
		$this->delete ();
	}
}
?>