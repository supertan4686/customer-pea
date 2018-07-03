<!DOCTYPE html>
<html>
<script>
  var base_url = "<?php echo base_url();?>";
  var a_base_url = base_url.split("/");
  if(!base_url.includes('customer-pea')){
    base_url = base_url + "customer-pea/";
  }
</script>
<?php 
  $a_base_url = explode("/", base_url());
  if(!in_array("customer-pea", $a_base_url)){
    $base_url = base_url() . 'customer-pea/';
  } else {
    $base_url = base_url();
  }
?>
<head>
  <meta charset="utf-8">
  <title>โปรแกรมตรวจสอบสถานะค้างชำระค่าไฟ กฟต.1</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo $base_url?>asset/fontawesome-free-5.0.10/web-fonts-with-css/css/fontawesome-all.css" type="text/css">
  <link rel="stylesheet" href="<?php echo $base_url?>asset/bootstrap4.0/css/bootstrap.css" type="text/css">
  <link rel="stylesheet" href="<?php echo $base_url?>asset/dataTables1.10.16/datatables.min.css"/>
  <link rel="stylesheet" href="<?php echo $base_url?>asset/mainpage.css" type="text/css">

</head>


<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="<?php echo site_url();?>">PEA System</a>
    </div>
  </nav>


 

        
