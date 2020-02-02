<?php
class model_goodsCate extends model_base {
	var $tableName = 'goods_cate';
	
	var $hasMany = array(
		array(
			'mappingName' => 'gcs',
			'tableClass' => 'model_goodsCate',
			'foreignKey' => 'pid',
		),
	);
	//查询父类
	function findSuper() {
		return $this->findAll(array ('pid' => 0 ));
	}
}
?>
