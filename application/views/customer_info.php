<div class="jumbotron" style="background-color:#460d5c; color:white;">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2>ข้อมูลลูกค้าค้างชำระค่าไฟฟ้า กฟต.1</h2>
        <?php echo isset($customer['customer_name']) ? "<h4>" . $customer['customer_name'] . "</h4>": "";?>
      </div>
    </div>
  </div>
</div>
  <div class="container">
  <div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
      <h5 class="mb-0" style="color:white;">
        ข้อมูลส่วนตัว
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
      <div class="row">
      <div class="col-12">
      <?php if(isset($customer['customer_name'])){ ?>
      <form>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">ชื่อ - นามสกุล</label>
          <div class="col-sm-10">
            <p class="col-form-label"><?php echo $customer['customer_name'];?></p>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">CA</label>
          <div class="col-sm-10">
            <p class="col-form-label"><?php echo $customer['ca'];?></p>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">ที่อยู่</label>
          <div class="col-sm-10">
            <p class="col-form-label"><?php echo $customer['address'];?></p>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">เบอร์โทรศัพท์</label>
          <div class="col-sm-10">
            <p class="col-form-label"><?php echo isset($tel) ? $customer['tel'] : "-";?></p>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">เขต</label>
          <div class="col-sm-10">
            <p class="col-form-label"><?php echo $customer['trsg'];?></p>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">สายการจดหน่วย</label>
          <div class="col-sm-10">
            <p class="col-form-label"><?php echo $customer['mru'];?></p>
          </div>
        </div>
      </form>
      <?php } else { ?>
        <p>ไม่ค้นพบข้อมูล</p>
      <?php }?>
      </div>
    </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" id="headingTwo">
      <h5 class="mb-0" style="color:white;">
      <?php echo 'ตารางสถิติการค้างชำระค้างไฟฟ้าของลูกค้ารายนี้ ในรอบ 12 เดือน ' . ' (' . $dateoutput['th_startmonth'] . ' ' . $dateoutput['startyear'] ?><?php echo ($dateoutput['th_endmonth'] == $dateoutput['th_startmonth'] && $dateoutput['startyear'] == $dateoutput['endyear']) ? ')' : ' - ' . $dateoutput['th_endmonth'] . ' ' . $dateoutput['endyear'] .')'?>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
      <div class="row">
      <!-- <div class="col-12"><h3>ตารางแสดงสถิติการติดสถานะค้างชำระรอบ 12 เดือน</h3></div> -->
    </div>
    <div class="row">
      <div class="col-12">
        <table class="table table-striped table-bordered" id="info" class="display" style="width:100%">
          <thead class="thead-dark">
            <tr>
              <th>เดือน / สถานะ</th>
              <th>ผ่อนผันครั้งที่ 1</th>
              <th>ผ่อนผันครั้งที่ 2</th>
              <th>ปลดสาย</th>
              <th>ถอดมิเตอร์</th>
              <th>จำนวนเงินที่ค้าง (บาท)</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($stat as $year => $month) { ?>
              <?php foreach ($month as $monthname => $status) { ?>
              <tr>
                <td><?php echo $monthname . " " . $year?></td>
                <td><?php echo $status['ผ่อนผันครั้งที่ 1'] == 1 ? '<h4>&#10003</h4>': "";?></td>
                <td><?php echo $status['ผ่อนผันครั้งที่ 2'] == 1 ? '<h4>&#10003</h4>' : "";?></td>
                <td><?php echo $status['ปลดสาย'] == 1 ? '<h4>&#10003</h4>' : "";?></td>
                <td><?php echo $status['ถอดมิเตอร์'] == 1 ? '<h4>&#10003</h4>' : "";?></td>
                <td>555</td>
              </tr>
              <?php
              }
            }?>
          </tbody>
        </table>
      </div>
    </div>
      </div>
    </div>
  </div>
  </div>
  </div>

  

