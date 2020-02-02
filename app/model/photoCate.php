<?php
class model_photoCate extends model_base {
	var $tableName = 'photo_cate';
	
	var $hasMany = array(
		array(
			'mappingName' => 'pcs',
			'tableClass' => 'model_photoCate',
			'foreignKey' => 'pid',
		),
		array(
			'mappingName' => 'phs',
			'tableClass' => 'model_photo',
			'foreignKey' => 'pc_id',
		),
	);
	//查询父类
	function findSuper() {
		return $this->findAll(array ('pid' => 0 ), 'sort_order');
	}
}
?>
