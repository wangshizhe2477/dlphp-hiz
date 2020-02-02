<?php
/**
 * Base controller
 */
class controller {
	
	var $_controllerName = null;
	
	var $_actionName = null;
	
	var $smarty;
	
	function __construct($controllerName) {
		$this->_controllerName = $controllerName;
		
		$this->smarty = $this->getSmarty ();
		
		//初始化系统参数
		$cos = m ( 'config' )->findAll ();
		foreach ( $cos as $key => $value ) {
			$ins [$value ['name']] = $value ['value'];
		}
		$this->assign ( 'inis', $ins );
	}
	
	//获取smarty配置
	private function getSmarty() {
		$smarty = new Smarty ();
		$smarty->template_dir = SMARTY_TEMPLATE_DIR;
		$smarty->compile_dir = SMARTY_COMPILE_DIR;
		$smarty->cache_dir = SMARTY_CACHE_DIR;
		$smarty->left_delimiter = SMARTY_LEFT_DELIMITER;
		$smarty->right_delimiter = SMARTY_RIGHT_DELIMITER;
		array_push ( $smarty->plugins_dir, SMARTY_PLUGINS_DIR );
		array_push ( $smarty->plugins_dir, SMARTY_PLUGINS_DIR . 'adm/' );
		return $smarty;
	}
	
	function _beforeExecute() {
		$this->assign ( 'a', $this->_actionName );
		$this->assign ( 'c', $this->_controllerName );
	}
	
	/* ------------------------- smarty封装 start --------------------------- */
	function display($tpl) {
		$this->smarty->display ( $tpl );
	}
	
	function assign($key, $value) {
		$this->smarty->assign ( $key, $value );
	}
	
	function get_template_vars($key) {
		return $this->smarty->get_template_vars ( $key );
	}
	
	/**
	 * 生成静态文件
	 */
	function fetch($tpl, $htmlName) {
		$content = $this->smarty->fetch ( $tpl, null, null, false );
		$fp = fopen ( $htmlName, 'w' );
		fwrite ( $fp, $content );
		fclose ( $fp );
	}
	
	/* ------------------------- smarty封装 end --------------------------- */
	
	/* ------------------------- 数据库操作封装 start --------------------------- */
	/**
	 * 自动分页
	 */
	function _pager($dao, $para = null, $sortby = null, $pageSize = 20, $reobj = 'obs') {
		$page = isset ( $_REQUEST ['page'] ) ? ( int ) $_REQUEST ['page'] : 0;
		FLEA::loadClass ( 'FLEA_Helper_Pager' );
		$pager = new FLEA_Helper_Pager ( $dao, $page, $pageSize, $para, $sortby );
		$obs = $pager->findAll ();
		$this->assign ( $reobj, $obs );
		$this->assign ( 'pager', $pager->getPagerData ( FALSE ) );
		return $obs;
	}
	//按sql语句分页
	function _pagerBySql($sql, $pageSize = 20, $reobj = 'obs') {
		$page = isset ( $_REQUEST ['page'] ) ? ( int ) $_REQUEST ['page'] : 0;
		FLEA::loadClass ( 'FLEA_Helper_Pager' );
		$pager = new FLEA_Helper_Pager ( $sql, $page, $pageSize);
		$obs = $pager->findAll ();
		$this->assign ( $reobj, $obs );
		$this->assign ( 'pager', $pager->getPagerData ( FALSE ) );
		return $obs;
	}
	
	
	/* ------------------------- 数据库操作封装 end --------------------------- */
	
	/************************* FLEA_Controller_Action start **************************/
	/**
	 * 系统调用
	 * 设置控制器名字，由 dispatcher 调用
	 */
	function __setController($controllerName, $actionName) {
		$this->_controllerName = $controllerName;
		$this->_actionName = $actionName;
	}
	
	/**
	 * 构建URL
	 */
	function _url($actionName = null, $args = null, $anchor = null) {
		return url ( $this->_controllerName, $actionName, $args, $anchor );
	}
	/************************* FLEA_Controller_Action end **************************/
}

/**
 * 管理员控制器
 */
class controller_adm extends controller {
	
	var $defaultModel = true; //是否自动初始化model
	var $dao = '';
	
	function __construct() {
		parent::__construct ();
		if (empty ( $_SESSION ['adminSession'] )) {
			redirect ( url ( 'admin' ) );
			exit ();
		}
	}
	
	function _beforeExecute() {
		parent::_beforeExecute ();
		if ($this->defaultModel && empty ( $this->dao ))
			$this->dao = m ( substr ( $this->_controllerName, 4, strlen ( $this->_controllerName ) - 4 ) );
	}
	
	/**
	 * 布局管理器
	 */
	function _view($view = null) {
		if (empty ( $view )) {
			$controllerName = $this->_controllerName;
			$this->assign ( 'mainPage', substr ( $controllerName, 4, strlen ( $controllerName ) - 4 ) );
		} else
			$this->assign ( 'mainPage', $view );
		$this->display ( 'adm/common/theme.html' );
	}
	
	/* ------------------------- 数据库操作封装 start --------------------------- */
	/**
	 * 处理1,0的逻辑字段
	 * 如果是1改为0,反之
	 */
	function logic($dao = null) {
		$updateField = $_REQUEST['a'];
		$dao = ($dao == null) ? $this->dao : $dao;
		if (! empty ( $_GET ['id'] )) {
			$ob = $dao->find ( $_GET ['id'] );
			if ($ob != null) {
				$ob [$updateField] = ($ob [$updateField] == 0) ? 1 : 0;
				$dao->update ( $ob );
				echo $ob [$updateField];
			}
		}
	}
	/**
	 * 排序时使用
	 * 更新排序
	 */
	function sort($dao = NULL) {
		$dao = ($dao == NULL) ? $this->dao : $dao;
		if (! empty ( $_REQUEST ['id'] ) && isset ( $_REQUEST ['sort'] )) {
			$ob = $dao->find ( $_REQUEST ['id'] );
			if ($ob != NULL) {
				$ob ['sort_order'] = $_REQUEST ['sort'];
				$dao->update ( $ob );
			}
		}
	}
	
	/**
	 * 删除
	 */
	function delete() {
		$id = ( int ) $_GET ['id'];
		if (empty ( $id ))
			exit ( '用户操作错误' );
		else {
			$this->dao->removeByPkv ( $id );
		}
		redirect ( lastUrl () );
	}
	/**
	 * 查看详细
	 */
	function x() {
		if (! empty ( $_REQUEST ['id'] )) {
			$ob = $this->dao->find ( $_REQUEST ['id'] );
			if ($ob != NULL) {
				$this->assign ( 'ob', $ob );
				$this->_view ();
			}
		}
	}
	/* ------------------------- 数据库操作封装 end --------------------------- */
}

/**
 * 前台控制器
 */
class mai_controller extends controller {
	
	function __construct() {
		parent::__construct ();
	}
	
	function _view($view = '') {
		if ($view == '')
			$view = $this->_actionName . '.html';
		$this->display ( 'theme' . DS . $view );
	}
}

/**
 * 会员后台控制器
 */
class user_controller extends controller {
	
	function __construct() {
		parent::__construct ();
		if (empty ( $_SESSION ['userSession'] )) {
			js_alert ( '请先登录', url('default', 'login') );
		}
		
		//当前用户子类调用
		$this->user = $_SESSION ['userSession'];
		$this->userId = $_SESSION ['userSession'] ['id'];
		$this->assign ( 'user', $this->user );
	}
	
	/* ************************ dao start *********************** */
	//获取ob
	function getOne($ado) {
		$id = ( int ) $_REQUEST ['id'];
		if (! empty ( $id )) {
			$ob = $ado->find ( $id );
			if (empty ( $ob ) || $ob ['us_id'] != $this->userId)
				exit ();
			return $ob;
		}
		return '';
	}
	//删除一条数据
	function delete($ado) {
		$ob = $this->getOne ( $ado );
		if (! empty ( $ob ) && $ob ['us_id'] == $this->userId) {
			$ado->removeByPkv ( $_REQUEST ['id'] );
			js_alert('删除成功', lastUrl());
		}
		js_alert('删除失败', lastUrl());
	}
	/* ************************ dao end *********************** */
	
	function _view() {
		$this->display ( 'user' . DS . 'common' . DS . 'theme.html' );
	}
}

?>