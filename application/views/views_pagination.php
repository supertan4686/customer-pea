<?php if ($total_rows > 0) { ?>                
  <div class="wrap-pagination">
    <div class="row">
      <div class="col-md-10">
        <p class="page-result"><?php echo $page ?> - <?php echo ceil($total_rows/$per_page);?> of <?php echo $total_rows; ?> Results</p>
      </div>
      <div class="col-md-2">
        <nav class="text-right">
            <?php
              $pagiantion = array(
                'url' => $url,
                'item_count' => $total_rows,
                'page' => $page,
                'limit' => $per_page,
                'a_query_temp' => $a_query_temp
              );
              $this->load->view("pagination", $pagiantion);
            ?>
        </nav>
      </div>
    </div>
  </div>
<?php } ?>
