<?php
function smarty_block_marquee($params, $content, &$smarty) {

	$style = empty ( $params ['style'] ) ? 'height:100%;width:100%;' : $params ['style'];
	$speed = empty ( $params ['speed'] ) ? 30 : $params ['speed'];
	$direction = empty ( $params ['direction'] ) ? 'up' : $params ['direction'];
	
	$marqueeFun = '';
	if($direction == 'up'){
		$marqueeFun = '
		if(colee2.offsetTop-colee.scrollTop<=0)
			colee.scrollTop-=colee1.offsetHeight;
		else
			colee.scrollTop++
		';
	}else if($direction == 'down'){
		$marqueeFun = '
		if(colee1.offsetTop-colee.scrollTop>=0)
			colee.scrollTop+=colee2.offsetHeight
		else
			colee.scrollTop--
		';
	}
	
	$str = '<div id="colee" style="overflow:hidden;' . $style . '">';
	$str .= '<div id="colee1">';
	$str .= $content;
	$str .= '</div>';
	$str .= '<div id="colee2"></div>';
	$str .= '</div>';
	$str .= '
<script>
var speed=' . $speed . ';
var colee2=document.getElementById("colee2");
var colee1=document.getElementById("colee1");
var colee=document.getElementById("colee");
colee2.innerHTML=colee1.innerHTML;
function marquee(){
	' . $marqueeFun . '
}
var myMar=setInterval(marquee,speed)
colee.onmouseover=function() {clearInterval(myMar)}
colee.onmouseout=function(){myMar=setInterval(marquee,speed)}
</script>';
	
	return $str;
}
?>
