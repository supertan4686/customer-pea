<?php 
  $a_base_url = explode("/", base_url());
  if(!in_array("customer-pea", $a_base_url)){
    $base_url = base_url() . 'customer-pea/';
  } else {
    $base_url = base_url();
  }
?>
  <script src="<?php echo $base_url;?>asset/jquery-3.3.1.min.js"></script>
  <script src="<?php echo $base_url;?>asset/popper.min.js" ></script>
  <script src="<?php echo $base_url;?>asset/bootstrap4.0/js/bootstrap.min.js"></script>
  <script src="<?php echo $base_url;?>asset/dataTables1.10.16/datatables.min.js"></script>
  <script src="<?php echo $base_url;?>asset/scriptsformainpage.js"></script>
</body>

</html>