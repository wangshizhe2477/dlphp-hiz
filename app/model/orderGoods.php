<?php
class model_orderGoods extends model_base {
	var $tableName = 'order_goods';
	
	var $belongsTo = array(
		array(
			'mappingName' => 'or',
			'tableClass' => 'model_order',
			'foreignKey' => 'or_id',
		),
		array(
			'mappingName' => 'go',
			'tableClass' => 'model_goods',
			'foreignKey' => 'go_id',
		),
	);
}
?>
