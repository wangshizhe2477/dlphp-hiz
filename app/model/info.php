<?php
class model_info extends model_base {
	var $tableName = 'info';
	
	var $belongsTo = array(
		array(
			'mappingName' => 'ic',
			'tableClass' => 'model_infoCate',
			'foreignKey' => 'ic_id',
		),
	);
}
?>
