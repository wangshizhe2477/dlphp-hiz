<?php
/**
 * 管理员管理
 */
class controller_adm_admin extends controller_adm {
	
	function __construct() {
		parent::__construct ();
	}
	function actionIndex() {
		$this->assign ( 'ads', $this->dao->findAll () );
		$this->_view ();
	}
	function actionToAdd() {
		$this->_view();
	}
	function actionAdd() {
		if (empty ( $_POST ['name'] ) || strlen ( $_POST ['name'] ) > 20)
			js_alert ( '用户名为空或过长', lastUrl());
		elseif (empty ( $_POST ['pass'] ) || strlen ( $_POST ['pass'] ) > 20)
			js_alert ( '密码为空或过长', lastUrl());
		elseif ($_POST ['pass'] != $_POST ['rePass'])
			js_alert ( '两次密码不一致', lastUrl());
		elseif ($this->dao->find ( array ('name' => $_POST ['name'] ) ) != NULL)
			js_alert ( '登陆名已存在', lastUrl());
		else {
			$array = array ('name' => $_POST ['name'], 'pass' => md5 ( $_POST ['pass'] ) );
			cScript ( $this->_url (), $this->dao->save ( $array ), '添加' );
		}
	}
	function actionToUpdatePass(){
		if(!empty($_REQUEST['id'])){
			$ob = $this->dao->find($_REQUEST['id']);
			if($ob != null){
				$this->assign('ob', $ob);
				$this->_view();
			}
		}
	}
	function actionUpdatePass(){
		if(empty($_POST['pass']))
			js_alert('密码不能为空', $this->_url('toUpdatePass', array('id' => $_REQUEST['id'])));
		elseif ($_POST['pass'] != $_POST['rePass'])
			js_alert('两次密码不一致', $this->_url('toUpdatePass', array('id' => $_REQUEST['id'])));
		else{
			if(!empty($_REQUEST['id'])){
				$ob = $this->dao->find($_REQUEST['id']);
				if($ob != null){
					$ob['pass'] = md5 ($_POST['pass']);
					$this->dao->update($ob);
					js_alert('修改成功', $this->_url());
				}
			}
		}
	}
	function actionDel() {
		$this->delete();
	}
	
	//修改个人密码
	function actionMyPass(){
		if($_POST){
			$pass = h($_REQUEST['pass']);
			$oldPass = h($_REQUEST['oldPass']);
			if(empty($oldPass))
				js_alert('请输入旧密码', lastUrl());
			elseif(empty($pass))
				js_alert('请输入新密码', lastUrl());
			else{
				$oldOb = $this->dao->find(array('id' => $_SESSION['adminSession']['id'], 'pass' => md5($oldPass)));
				if(empty($oldOb))
					js_alert('原始密码不正确', lastUrl());
				else{
					$oldOb['pass'] = md5($pass);
					$this->dao->update($oldOb);
					$_SESSION['adminSession'] = $oldOb;
					js_alert('密码修改成功', lastUrl());
				}
			}
		}
		$this->_view();
	}
	
}
?>
