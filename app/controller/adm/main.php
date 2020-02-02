<?php
class controller_adm_main extends controller_adm {
	
	function __construct() {
		parent::__construct ();
	}
	function actionIndex() {
		if (! empty ( $_REQUEST ['id'] )) {
			$ob = $this->dao->find ( $_REQUEST ['id'] );
			if (! empty ( $ob )) {
				$this->assign ( 'ob', $ob );
				$this->_view ();
			}
		}
	}
	function actionEdit() {
		$id = ( int ) $_REQUEST ['id'];
		if (! empty ( $id )) {
			$ob = $this->dao->find ( $id );
			if (! empty ( $ob )) {
				$ob ['name'] = h ( $_POST ['name'] );
				$ob ['other'] = clear_js ( $_REQUEST ['other'] );
				$this->dao->update ($ob);
				js_alert ( '提交成功', lastUrl () );
			}
		}
	}
}
?>
