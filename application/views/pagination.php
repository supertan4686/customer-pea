<?php
if(empty($url)) return ;
if(!isset($a_query_temp) && empty($a_query_temp)) $a_query_temp = array();
?>
<ul class="pagination pagination-sm">
	<?php
	$page_total = ceil($item_count/$limit);
	$page_show = 6;
	$page_start = $page - floor($page_show/2);
	$page_end = $page_start + $page_show - 1;
	if($page_start < 1){
		$page_end += 1 - $page_start;
		$page_start = 1;
	}
	if($page_end > $page_total){
		$page_start -= $page_end - $page_total;
		$page_end = $page_total;
	}
	$page_start = max(1, $page_start);
	$page_end = min($page_total, $page_end);
	
	if($page != 1){
		$a_query = $a_query_temp;
		$a_query['page'] = 1;
		?>
		<li><a href="<?php echo site_url($url.'?'.http_build_query($a_query)) ?>">&laquo;</a></li>
		<?php
		$a_query = $a_query_temp;
		$a_query['page'] = $page - 1;
		?>
		<!-- <li><a href="<?php //echo site_url($url.'?'.http_build_query($a_query)) ?>">&lt;</a></li> -->
		<?php
	}
	for($i = $page_start; $i <= $page_end ; $i++){
		$a_query = $a_query_temp;
		$a_query['page'] = $i;
		if($page == $i){
			?><li class="active"><a><?php echo number_format($i) ?></a></li><?php
		}else{
			?><li><a href="<?php echo site_url($url.'?'.http_build_query($a_query)) ?>"><?php echo number_format($i) ?></a></li><?php
		}
	}
	if($page < $page_total){
		$a_query = $a_query_temp;
		$a_query['page'] = $page + 1;
		?>
		<!-- <li><a href="<?php //echo site_url($url.'?'.http_build_query($a_query)) ?>">&gt;</a></li> -->
		<?php
		$a_query = $a_query_temp;
		$a_query['page'] = $page_total;
		?>
		<li><a href="<?php echo site_url($url.'?'.http_build_query($a_query)) ?>">&raquo;</a></li> 
		<?php
	}
	?>
</ul>