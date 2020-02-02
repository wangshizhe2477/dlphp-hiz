<?php
/* 职位 */
function smarty_modifier_job() {
	return m ( 'job' )->findAll ( null, 'endtime' );
}
?>
