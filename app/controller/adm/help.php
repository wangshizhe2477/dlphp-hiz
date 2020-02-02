<?php
/**
 * 管理员管理
 */
class controller_adm_help extends controller_adm {
	
	function __construct() {
		parent::__construct ();
		$this->defaultModel = false;
	}
	
	function actionIndex() {
	}
	//注意事项
	function actionWard() {
		$this->_view ();
	}
	/**
	 * 备份数据库
	 */
	//进入数据库备份
	function actionBackUpTo() {
		$this->assign ( 'fis', show_dir ( ROOT . 'backup' ) );
		$this->_view ();
	}
	//数据库备份
	function actionBackUp() {
		cScript ( $this->_url ( 'backUpTo' ), m ( 'dbBackup' )->backupDB (), '数据库备份' );
	}
	//删除备份文件
	function actionBackUpDel() {
		if (! empty ( $_REQUEST ['name'] ))
			unlink ( ROOT . 'backup' . DS . $_REQUEST ['name'] . '.php' );
		js_alert('操作成功', $this->_url ( 'backUpTo' ));
	}
	/**
	 * 上传文件清理
	 */
	//上传文件列表
	function actionUpload() {
		$dir = ROOT . 'lib' . DS . 'kindeditor' . DS . 'attached';
		$fis = show_dir ( $dir );
		$res = array ();
		foreach ( $fis as $value ) {
			$fis2 = show_dir ( $dir . DS . $value );
			foreach ( $fis2 as $value2 ) {
				$file ['type'] = substr ( $value2, - 3 );
				$file ['name'] = substr ( $value . DS . $value2, 0, - 4 );
				$file ['size'] = ceil ( filesize ( $dir . DS . $value . DS . $value2 ) / 1024 ) . 'KB';
				$file ['fulname'] = $value . DS . $value2;
				array_push ( $res, $file );
			}
		}
		$this->assign ( 'fis', $res );
		$this->_view ();
	}
	//删除上传文件
	function actionUploadDel() {
		if (! empty ( $_GET ['fulname'] )) {
			unlink ( ROOT . 'lib' . DS . 'kindeditor' . DS . 'attached' . DS . $_GET ['fulname'] );
			redirect ( $this->_url ( 'upload' ) );
		}
	}
	/**
	 * 计算器
	 */
	function actionCalc() {
		$this->display ( 'adm/help.html' );
	}
}
?>
