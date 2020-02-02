<?php
class model_order extends model_base {
	var $tableName = 'order';
	
	var $hasMany = array(
		array(
			'mappingName' => 'ogs',
			'tableClass' => 'model_orderGoods',
			'foreignKey' => 'go_id',
		),
	);
}
?>
