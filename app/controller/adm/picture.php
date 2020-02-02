<?php
/**
 * 网站固定图片替换
 * name 图片文件名
 */
class controller_adm_picture extends controller_adm {
	
	function __construct() {
		parent::__construct ();
	}
	
	function actionIndex() {
		$this->assign ( 'obs', $this->dao->findAll ( null, 'name desc' ) );
		$this->_view ();
	}
	
	//添加新管理记录
	function actionAddTo() {
		$this->_view ();
	}
	
	function actionAdd() {
		$ob ['name'] = h ( $_REQUEST ['name'] );
		$ob ['width'] = h ( $_REQUEST ['width'] );
		$ob ['height'] = h ( $_REQUEST ['height'] );
		$ob ['file'] = h ( $_REQUEST ['file'] );
		if (empty ( $ob ['name'] ))
			js_alert ( '名称不能为空', lastUrl () );
		elseif (empty ( $ob ['file'] ))
			js_alert ( '文件名称不能为空', lastUrl () );
		else {
			$file_ext = substr ( $ob ['file'], strlen ( $ob ['file'] ) - 3, strlen ( $ob ['file'] ) );
			if ($file_ext != 'jpg' && $file_ext != 'png' && $file_ext != 'gif')
				js_alert ( '图片格式不正确', lastUrl () );
			$this->dao->save ( $ob );
			js_alert ( '提交成功', $this->_url () );
		}
	}
	
	//修改管理记录
	function actionEditTo() {
		$id = ( int ) $_REQUEST ['id'];
		if (! empty ( $id )) {
			$ob = $this->dao->find ( $id );
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
				$uploader = new fileUploader ();
				if (! $uploader->isFileExist ( 'photo' )) {
					js_alert ( '请选择要上传的文件', lastUrl () );
				} else {
					$photo = $uploader->getFile ( 'photo' );
					$photo->move ( 'img' . DS . $ob ['file'] );
					js_alert ( '提交成功', $this->_url () );
				}
			}
		}
	}
	
	function actionUpload(){
		$uploader = new fileUploader ();
		if (! $uploader->isFileExist ( 'photo' )) {
			js_alert ( '请选择要上传的文件', lastUrl () );
		} else {
			$photo = $uploader->getFile ( 'photo' );
			$ext = $photo->getExt();
			if($ext == 'jpg' || $ext == 'png' || $ext == 'gif'){
				$photo->move ( 'img' . DS . $photo->getFilename() );
				js_alert ( '提交成功', $this->_url () );
			}else
				js_alert ( '文件格式不正确', $this->_url () );
		}
	}
}
?>