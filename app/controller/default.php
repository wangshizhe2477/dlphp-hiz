<?php
class controller_default extends mai_controller {
	
	function __construct() {
		parent::__construct ();
	}
	
	function actionIndex() {
		$this->_view ();
	}
	
	/* ------------------------------------ 文章内容 start ------------------------------------- */
	function actionMain() {
		if (! empty ( $_REQUEST ['id'] )) {
			$ma = m ( 'main' )->find ( $_REQUEST ['id'] );
			if ($ma != null) {
				$this->assign ( 'ob', $ma );
				$this->_view ();
			}
		}
	}
	
	function actionInfo() {
		$array = array ();
		if (! empty ( $_REQUEST ['ic_id'] )) {
			$array ['ic_id'] = $_REQUEST ['ic_id'];
			$infoCate = m ( 'infoCate' );
			$this->assign ( 'ic', $infoCate->find ( $_REQUEST ['ic_id'] ) );
		}
		if (! empty ( $_REQUEST ['name'] ))
			array_push ( $array, array ('name', '%' . $_REQUEST ['name'] . '%', 'like' ) );
		$this->_pager ( m ( 'info' ), $array, 'sort_order, createtime desc', 11 );
		$this->_view ();
	}
	
	function actionInfoX() {
		if (! empty ( $_REQUEST ['id'] )) {
			$info = m ( 'info' );
			$ob = $info->find ( $_REQUEST ['id'] );
			$ob ['hit'] ++;
			$info->update ( $ob );
			$this->assign ( 'ob', $ob );
			$this->assign ( 'ic', $ob ['ic'] );
			$this->_view ();
		}
	}
	
	function actionPhoto() {
		$photo = m ( 'photo' );
		$array = array ();
		if (! empty ( $_REQUEST ['pc_id'] )) {
			$array ['pc_id'] = $_REQUEST ['pc_id'];
			$photoCate = m ( 'photoCate' );
			$this->assign ( 'pc', $photoCate->find ( $_REQUEST ['pc_id'] ) );
		}
		if (! empty ( $_REQUEST ['up'] ))
			$array ['up'] = 1;
		if (! empty ( $_REQUEST ['name'] ))
			array_push ( $array, array ('name', '%' . $_REQUEST ['name'] . '%', 'like' ) );
		$this->_pager ( $photo, $array, 'sort_order, createtime desc', 12 );
		$this->_view ();
	}
	
	function actionPhotoX() {
		if (! empty ( $_REQUEST ['id'] )) {
			$photo = m ( 'photo' );
			$this->assign ( 'ob', $photo->find ( $_REQUEST ['id'] ) );
			$this->_view ();
		}
	}
	
	function actionExample() {
		$this->_pager ( m ( 'example' ), array ('ec_id' => $_REQUEST ['ec_id'] ), 'sort_order, createtime desc', 15 );
		$this->_view ();
	}
	function actionExampleX() {
		if (! empty ( $_REQUEST ['id'] )) {
			$this->assign ( 'ob', m ( 'example' )->find ( $_REQUEST ['id'] ) );
			$this->_view ();
		}
	}
	/* ------------------------------------ 文章内容 end ------------------------------------- */
	/* ------------------------------------ 留言板 start ------------------------------------- */
	function actionMessage() {
		//$this->_pager ( m ( 'message' ), array (array ('reother', '', '!=' ) ), NULL, 5 );
		$this->_view ();
	}
	function actionMessageSub() {
		if (empty ( $_REQUEST ['name'] ))
			js_alert ( '姓名不能为空', lastUrl () );
		elseif (! is_email ( $_POST ['mail'] ))
			js_alert ( 'E-mail格式不正确', lastUrl () );
		else {
			$ob ['company'] = h ( $_POST ['company'] );
			$ob ['name'] = h ( $_POST ['name'] );
			$ob ['realname'] = h ( $_POST ['realname'] );
			$ob ['mail'] = h ( $_POST ['mail'] );
			$ob ['tel'] = h ( $_POST ['tel'] );
			$ob ['addr'] = h ( $_POST ['addr'] );
			$ob ['fax'] = h ( $_POST ['fax'] );
			$ob ['other'] = h ( $_POST ['other'] );
			m ( 'message' )->save ( $ob );
			js_alert ( '感谢您的留言', lastUrl () );
		}
	}
	/* ------------------------------------ 留言板 end ------------------------------------- */
	/* ------------------------------------ 人才招聘 start ------------------------------------- */
	/* 职位 */
	function actionJob() {
		$this->_view ();
	}
	//进入应聘页面
	function actionResume() {
		if (! empty ( $_REQUEST ['id'] ))
			$this->assign ( 'jo', m ( 'job' )->find ( $_REQUEST ['id'] ) );
		$this->_view ();
	}
	//提交简历
	function actionResumeSub() {
		if (empty ( $_POST ['name'] ) || empty ( $_POST ['phone'] ))
			js_alert ( '姓名和联系方式不能为空', lastUrl () );
		else {
			$ob ['job'] = $_POST ['job'];
			$ob ['name'] = $_POST ['name'];
			$ob ['sex'] = $_POST ['sex'];
			$ob ['birthday'] = $_POST ['birthday'];
			$ob ['marriage'] = $_POST ['marriage'];
			$ob ['school'] = $_POST ['school'];
			$ob ['edue'] = $_POST ['edue'];
			$ob ['national'] = $_POST ['national'];
			$ob ['educ'] = $_POST ['educ'];
			$ob ['schooltime'] = $_POST ['schooltime'];
			$ob ['phone'] = $_POST ['phone'];
			$ob ['mail'] = $_POST ['mail'];
			$ob ['addr'] = $_POST ['addr'];
			$ob ['other'] = $_POST ['other'];
			$ob ['info'] = $_POST ['info'];
			m ( 'resume' )->create ( $ob );
			js_alert ( '简历提交', lastUrl () );
		}
	}
	/* ------------------------------------ 人才招聘 end -------------------------------------*/
	/* ------------------------------------ 会员信息 start -------------------------------------*/
	//会员登陆
	function actionLogin() {
		$this->_view ();
	}
	
	function actionLoginSub() {
		if (empty ( $_POST ['name'] ) || empty ( $_POST ['pass'] ))
			js_alert ( '用户名密码不能为空', lastUrl () );
		else {
			$us = m ( 'user' )->find ( array ('name' => $_POST ['name'], 'pass' => encrypt ( $_POST ['pass'] ) ) );
			if ($us == null)
				js_alert ( '用户密码或密码不正确', lastUrl () );
			else {
				$_SESSION ['userSession'] = $us;
				js_alert ( '登陆成功', url ( 'user' ) );
			}
		}
	}
	//进入会员注册页面
	function actionRegion() {
		$this->_view ();
	}
	//AJAX判断用户名
	function actionAjaxCheckName() {
		if (empty ( $_GET ['name'] ))
			echo 2;
		else {
			$user = m ( 'user' );
			$ob = $user->find ( array ('name' => $_GET ['name'] ) );
			if ($ob == NULL)
				echo 0;
			else
				echo 1;
		}
	}
	function actionRegionSub() {
		$user = m ( 'user' );
		if (empty ( $_POST ['name'] ))
			js_alert ( '用户名不能为空', lastUrl () );
		elseif (empty ( $_POST ['pass'] ))
			js_alert ( '密码不能为空', lastUrl () );
		elseif ($_POST ['pass'] != $_POST ['repass'])
			js_alert ( '两次密码不一致', lastUrl () );
		elseif ($user->find ( array ('name' => $_REQUEST ['name'] ) ) != null)
			js_alert ( '用户名已存在', lastUrl () );
		else {
			$us ['name'] = $_POST ['name'];
			$us ['pass'] = encrypt ( $_POST ['pass'] );
			$us ['mail'] = $_POST ['mail'];
			$us ['tel'] = $_POST ['tel'];
			$us ['addr'] = $_POST ['addr'];
			$us ['birthday'] = $_POST ['birthday'];
			$us ['number'] = $_POST ['number'];
			$user->save ( $us );
			js_alert ( '注册成功', $this->_url () );
		}
	}
	//找回密码
	function actionFindPass() {
		$this->_view ();
	}
	function actionFindPassSub() {
		$user = m ( 'user' );
		$us = $user->find ( array ('name' => $_POST ['name'], 'number' => $_POST ['number'] ) );
		if ($us == null)
			js_alert ( '证件号码和帐户不一致', lastUrl () );
		elseif (empty ( $_POST ['name'] ))
			js_alert ( '用户名不能为空', lastUrl () );
		elseif (empty ( $_POST ['pass'] ))
			js_alert ( '密码不能为空', lastUrl () );
		elseif ($_POST ['pass'] != $_POST ['repass'])
			js_alert ( '两次密码不一致', lastUrl () );
		else {
			$us ['pass'] = encrypt ( $_POST ['pass'] );
			$user->update ( $us );
			js_alert ( '密码修改成功', $this->_url () );
		}
	}
	//会员退出
	function actionLogoff() {
		if (isset ( $_SESSION ['userSession'] ))
			unset ( $_SESSION ['userSession'] );
		js_alert ( '用户已退出', $this->_url () );
	}
	/* ------------------------------------ 会员信息 end -------------------------------------*/
	
	/* ------------------------------------ 购物流程 start -------------------------------------*/
	function actionCart() {
		$flow = $_REQUEST['flow'];
		if(empty($flow)){//购物车
			$this->_view ();
		}
	}
	/* ------------------------------------ 购物流程 end -------------------------------------*/

}
?>