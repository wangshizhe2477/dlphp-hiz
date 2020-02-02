<?php
function smarty_function_pager($params, &$smarty) {
	$pager = $smarty->get_template_vars ( 'pager' );
	
	$c = '';
	$a = '';
	$para = array();
	foreach ( $_REQUEST as $key => $value ) {
		if ($key != 'page') {
			if($key == 'c')
				$c = $value;
			elseif($key == 'a')
				$a = $value;
			else
				$para[$key] = $value;
		}
	}
	
	$firstPara = $para;
	$firstPara['page'] = $pager['firstPage'];
	$firstUrl = url($c, $a, $firstPara);
	
	$prevPara = $para;
	$prevPara['page'] = $pager['prevPage'];
	$prevUrl = url($c, $a, $prevPara);
	
	$nextPara = $para;
	$nextPara['page'] = $pager['nextPage'];
	$nextUrl = url($c, $a, $nextPara);
	
	$lastPara = $para;
	$lastPara['page'] = $pager['lastPage'];
	$lastUrl = url($c, $a, $lastPara);
	
	echo "<div id='pager'>";
	if (empty ( $params ['code'] )) {
		echo "共{$pager['count']}条数据 共{$pager['pageCount']}页 当前第{$pager['currentPageNumber']}页 ";
		if ($pager ['currentPageNumber'] != 1) {
			echo "<a href=\"{$firstUrl}\">首页 </a> ";
			echo "<a href=\"{$prevUrl}\">上一页 </a>";
		} else {
			echo '首页 ';
			echo '上一页 ';
		}
		if ($pager ['currentPageNumber'] != $pager ['pageCount']) {
			echo "<a href=\"{$nextUrl}\">下一页 </a>";
			echo "<a href=\"{$lastUrl}\">尾页 </a>";
		} else {
			echo '下一页 ';
			echo '尾页 ';
		}
	} elseif ($params ['code'] == 'en') {
		echo "Total {$pager['count']} be the data of {$pager['pageCount']} page Current {$pager['currentPageNumber']} page";
		if ($pager ['currentPageNumber'] != 1) {
			echo "<a href=\"{$firstUrl}\">First </a> ";
			echo "<a href=\"{$prevUrl}\">Last </a>";
		} else {
			echo 'First ';
			echo 'Last ';
		}
		if ($pager ['currentPageNumber'] != $pager ['pageCount']) {
			echo "<a href=\"{$nextUrl}\">Next </a>";
			echo "<a href=\"{$lastUrl}\">End </a>";
		} else {
			echo 'Next ';
			echo 'End ';
		}
	}
	echo '</div>';
}
?>