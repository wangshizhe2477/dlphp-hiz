<?php
/**
 * 会员管理后台
 */
class controller_user extends user_controller {
	
	function __construct() {
		parent::__construct ();
	}
	
	function actionIndex() {
		$this->_view ();
	}
	//-----------------------个人信息 start-----------------------
	//修改会员信息
	function actionUserEdit() {
		if ($_POST) {
			$ob = $this->user;
			$ob ['realname'] = h ( $_POST ['realname'] );
			$ob ['mail'] = h ( $_POST ['mail'] );
			$ob ['tel'] = h ( $_POST ['tel'] );
			$ob ['addr'] = h ( $_POST ['addr'] );
			$ob ['fax'] = h ( $_POST ['fax'] );
			$ob ['company'] = h ( $_POST ['company'] );
			m ( 'user' )->update ( $ob );
			$_SESSION ['userSession'] = $ob;
			js_alert ( '提交成功', lastUrl () );
		}
		
		$this->_view ();
	}
	
	//修改个人密码
	function actionUserEditPass() {
		if ($_POST) {
			if (empty ( $_POST ['oldPass'] ) || md5 ( $_POST ['oldPass'] ) != $_SESSION ['userSession'] ['pass'])
				js_alert ( '原始密码不正确', lastUrl () );
			elseif (empty ( $_POST ['pass'] ))
				js_alert ( '密码不能为空', lastUrl () );
			elseif ($_POST ['pass'] != $_POST ['rePass'])
				js_alert ( '两次密码不一致', lastUrl () );
			else {
				$ob = $this->user;
				$ob ['pass'] = md5 ( $_POST ['pass'] );
				m ( 'user' )->update ( $ob );
				$_SESSION ['userSession'] = $ob;
				js_alert ( '密码修改成功', lastUrl () );
			}
		}
		$this->_view ();
	}
	
	//-----------------------个人信息 end-------------------------
	

	//-----------------------搜藏夹 start-------------------------
	function actionFavorite() {
		$para ['us_id'] = $this->userId;
		$this->_pager ( m ( 'user_favorite' ), $para, 'id desc' );
		$this->_view ();
	}
	
	function actionFavoriteEdit() {
		$ob = $this->getOne ( m ( 'user_favorite' ) );
		
		if ($_POST) {
			$ob ['us_id'] = $this->userId;
			$ob ['name'] = h ( $_POST ['name'] );
			$ob ['url'] = h ( $_POST ['url'] );
			m ( 'user_favorite' )->save ( $ob );
			js_alert ( '提交成功', $this->_url ( 'favorite' ) );
		}
		$this->assign ( 'ob', $ob );
		$this->_view ();
	}
	
	function actionFavoriteDel() {
		$this->delete ( m ( 'user_favorite' ) );
	}

	//-----------------------搜藏夹 end-------------------------
	
	//-----------------------订单 start-------------------------
	function actionOrder(){
		$para ['us_id'] = $this->userId;
		$this->_pager ( m ( 'orderGoods' ), $para, 'id desc' );
		$this->_view ();
	}
	//-----------------------订单 end-------------------------
}
?>