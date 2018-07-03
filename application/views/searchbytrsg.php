<div class="jumbotron" style="background-color:#460d5c; color:white;">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2>ค้นหารายการลูกค้าค้างชำระค่าไฟฟ้าของ กฟต.1 แต่ละเขต</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-12" style="margin-top:20px">
          <form method="GET" id="searchfrom" name="searchfrom" action="">
            <ul class="search">
              <li>
								<input type="hidden" id="trsgform" name="trsgform" value="<?php echo $formselected['trsg'];?>">
                <div class="dropdown">
									<label>สำนักงานไฟฟ้า</label>
                  <button class="btn btn-round btn-border border-white dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="font-size:14px;">
                  <?php echo $formselected['trsg_name'];?><span class="caret"></span></button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="max-height:200px;overflow-y:auto">
										<?php
                  		foreach ($trsg as $key => $value) { ?>
                  			<li data-value="<?php echo $value['trsg_id'];?>" <?php echo ($formselected['trsg'] == $value['trsg_id'] ? " selected='selected'" : "");?>><a href="#" onclick="selectmenu1(this);"><?php echo $value['trsg_name'];?></a></li>
											<?php
											}
                  	?>
                  </ul>
                </div>
              </li>
							<li>
								<input type="hidden" id="amountmonthform" name="amountmonthform" value="<?php echo $formselected['amount'] == 'all' ? 'all' : $formselected['amount'];?>">
                <div class="dropdown">
									<label>จำนวนรอบเดือน</label>
                  <button class="btn btn-round btn-border border-white dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="font-size:14px;">
                  <?php echo $formselected['amountmonth_name'];?><span class="caret"></span>
                  </button>                      
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu2" style="max-height:200px;overflow-y:auto">
										<li data-value="1" <?php echo (1 == $formselected['amount'] ? " selected='selected'" : "");?>><a href="#" onclick="selectmenu2(this);">1 เดือน</a></li>
                    <li data-value="2" <?php echo (2 == $formselected['amount'] ? " selected='selected'" : "");?>><a href="#" onclick="selectmenu2(this);">2 เดือน</a></li>
                    <li data-value="3" <?php echo (3 == $formselected['amount'] ? " selected='selected'" : "");?>><a href="#" onclick="selectmenu2(this);">3 เดือน</a></li>
                    <li data-value="4" <?php echo (4 == $formselected['amount'] ? " selected='selected'" : "");?>><a href="#" onclick="selectmenu2(this);">4 เดือน</a></li>
                    <li data-value="5" <?php echo (5 == $formselected['amount'] ? " selected='selected'" : "");?>><a href="#" onclick="selectmenu2(this);">5 เดือน</a></li>
                    <li data-value="6" <?php echo (6 == $formselected['amount'] ? " selected='selected'" : "");?>><a href="#" onclick="selectmenu2(this);">6 เดือน</a></li>
                    <li data-value="7" <?php echo (7 == $formselected['amount'] ? " selected='selected'" : "");?>><a href="#" onclick="selectmenu2(this);">7 เดือน</a></li>
                    <li data-value="8" <?php echo (8 == $formselected['amount'] ? " selected='selected'" : "");?>><a href="#" onclick="selectmenu2(this);">8 เดือน</a></li>
                    <li data-value="9" <?php echo (9 == $formselected['amount'] ? " selected='selected'" : "");?>><a href="#" onclick="selectmenu2(this);">9 เดือน</a></li>
                    <li data-value="10" <?php echo (10 == $formselected['amount'] ? " selected='selected'" : "");?>><a href="#" onclick="selectmenu2(this);">10 เดือน</a></li>
                    <li data-value="11" <?php echo (11 == $formselected['amount'] ? " selected='selected'" : "");?>><a href="#" onclick="selectmenu2(this);">11 เดือน</a></li>
                    <li data-value="12" <?php echo (12 == $formselected['amount'] ? " selected='selected'" : "");?>><a href="#" onclick="selectmenu2(this);">12 เดือน</a></li>
                  </ul>
                </div>
              </li>
							<li>
								<input type="hidden" id="statusform" name="statusform" value="<?php echo $formselected['status'] == 'all' ? 'all' : $formselected['status'];?>">
                <div class="dropdown">
									<label>สถานะ</label>
                  <button class="btn btn-round btn-border border-white dropdown-toggle" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="font-size:14px;">
                  <?php echo $formselected['status_name'];?><span class="caret"></span>
                  </button>                      
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu3" style="max-height:200px;overflow-y:auto">
									<li data-value="all" <?php echo ($formselected['status'] == 'all' ? " selected='selected'" : "");?>><a href="#" onclick="selectmenu3(this);">ทั้งหมด</a></li>
									<?php
                  		foreach ($status as $key => $value) { ?>
                  			<li data-value="<?php echo $value['status_name'];?>" <?php echo ($formselected['status'] == $value['status_id'] ? " selected='selected'" : "");?>><a href="#" onclick="selectmenu3(this);"><?php echo $value['status_name'];?></a></li>
											<?php
											}
                  	?>
                  </ul>
                </div>
              </li>
              <li>
                <button class="btn btn-round langmenu btn-border border-white" onclick="$('#searchfrom').submit();"><i class="fas fa-search"></i></button>           
              </li>
							<li>
								<button type="button" class="btn btn-round langmenu btn-border border-white" onclick="exportexcelsearchbytrsg()">ดาวน์โหลดเป็นไฟล์ Excel</button>	
							</li>
            </ul>
					</form>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row" style="margin-bottom:10px;">
      <div class="col-12">
        <h4 align="center"><?php echo 'ตารางรายการลูกค้าค้างชำระค่าไฟฟ้าเขต ' . $formselected['trsg_name'] . ' ในรอบ ' . $formselected['amountmonth_name'] . ' (' . $dateoutput['th_startmonth'] . ' ' . $dateoutput['startyear'] ?><?php echo ($dateoutput['th_endmonth'] == $dateoutput['th_startmonth'] && $dateoutput['startyear'] == $dateoutput['endyear']) ? ')' : ' - ' . $dateoutput['th_endmonth'] . ' ' . $dateoutput['endyear'] .')'?></h4>
      </div>
    </div>
  </div>
  <table class="table table-striped table-bordered" id="example" class="display" style="width:100%">
    <thead class="thead-dark">
      <tr>
        <th>#</th>
        <th>CA</th>
        <th>ชื่อ - นามสกุล</th>
        <th>เบอร์โทรศัพท์</th>
        <?php
        foreach ($formselected['a_status'] as $key => $status) { ?>
          <th><?php echo $status;?></th>
        <?php
        }
        ?>
        <th>รายละเอียดข้อมูลผู้ค้างชำระ</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($data as $index => $info) {
        echo '<tr>';
          echo '<td>' . ($index+1) . '</td>';
          foreach ($info as $key => $value) {
            if($key == "detail"){
            echo '<td><a href="' . $value . '" target="_blank" style="color:#460d5c;">รายละเอียด</a></td>';
            } else {
              if($key == "tel"){
                if($value == ""){
                  echo '<td>-</td>';
                } else {
                  echo '<td>' . $value . '</td>';
                }
              } else {
                echo '<td>' . $value . '</td>';
              }
            }
          }
        echo '</tr>';
      } ?>
    </tbody>
  </table>
  
