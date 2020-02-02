<?php
/**
 * 视频管理
 * @author Wang Shizhe
 */
class controller_adm_vo extends controller_adm {
	
	function __construct() {
		parent::__construct ();
		$this->assign ( 'vc', m ( 'voCate' )->find ( $_REQUEST ['vc_id'] ) );
	}
	
	function actionIndex() {
		$this->_pager ( $this->dao, array ('vc_id' => $_REQUEST ['vc_id'] ), 'createtime desc' );
		$this->_view ();
	}
	function actionToEdit() {
		if (! empty ( $_REQUEST ['id'] ))
			$this->assign ( 'ob', $this->dao->find ( $_REQUEST ['id'] ) );
		$this->_view ();
	}
	function actionEdit() {
		if (! empty ( $_POST ['id'] ))
			$ob = $this->dao->find ( $_POST ['id'] );
		$ob ['photo'] = upload_photo ( $ob ['photo'] );
		$ob ['vc_id'] = h ( $_REQUEST ['vc_id'] );
		$ob ['name'] = h ( $_POST ['name'] );
		$ob ['url'] = h ( $_POST ['url'] );
		$ob ['other'] = clear_js ( $_POST ['other'] );
		cScript ( $_POST ['lastUrl'], $this->dao->save ( $ob ), '编辑' );
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