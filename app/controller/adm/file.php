<?php
class controller_adm_file extends controller_adm {
	
	function __construct() {
		parent::__construct ();
	}
	function actionIndex() {
		$this->_pager ( $this->dao );
		$this->_view ();
	}
	function actionToEdit() {
		$this->_view ();
	}
	function actionEdit() {
		$fileName = r_filename ();
		$uploader = new fileUploader ();
		if ($uploader->isFileExist ( 'file' )) {
			$file = $uploader->getFile ( 'file' );
			$ext = $file->getExt ();
			if ($ext != 'php' && $ext != 'exe') {
				$fileName .= '.' . $ext;
				if ($file->move ( UPLOAD . $fileName )) {
					$ob ['file'] = $fileName;
					$ob ['name'] = h ( $_POST ['name'] );
					$this->dao->save ( $ob );
					js_alert ( '编辑成功', $this->_url () );
				} else
					js_alert ( '上传失败', $this->_url ( 'toEdit' ) );
			}
		} else
			js_alert ( '请选择上传文件', $this->_url ( 'toEdit' ) );
	}
	function actionDel() {
		$this->delete ();
	}
}
?>