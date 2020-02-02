<?php
class model_photo extends model_base {
	var $tableName = 'photo';
	
	var $belongsTo = array(
		array(
			'mappingName' => 'pc',
			'tableClass' => 'model_photoCate',
			'foreignKey' => 'pc_id',
		),
	);
	
	var $hasMany = array(
		array(
			'mappingName' => 'pps',
			'tableClass' => 'model_photoPhoto',
			'foreignKey' => 'ph_id',
		),
	);
	
}
?>
