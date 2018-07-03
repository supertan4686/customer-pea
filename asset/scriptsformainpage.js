function selectmenu1 (obj) {
  var selText = $(obj).text();
  $("#dropdownMenu1").html(selText+' <span class="caret"></span>');
  $("#trsgform").attr('value', $(obj).parent('li').data('value'));
}

function selectmenu2 (obj) {
  var selText = $(obj).text();
  $("#dropdownMenu2").html(selText+' <span class="caret"></span>');
  $("#amountmonthform").attr('value', $(obj).parent('li').data('value'));
}

function selectmenu3 (obj) {
  var selText = $(obj).text();
  $("#dropdownMenu3").html(selText+' <span class="caret"></span>');
  $("#statusform").attr('value', $(obj).parent('li').data('value'));
}

function exportexcelsearchbytrsg () {
  var trsg = $("#trsgform").val();
  var status = $("#statusform").val();
  var amount = $("#amountmonthform").val();
  var url = base_url + 'search/ajax_export_searchbytrsg';
  $.ajax({
    method: "POST",
    url: url,
    data: { 
      trsg: trsg, 
      status: status,
      amount: amount, 
    }
  })
    .done(function( link ) {
      window.open(link , '_blank');
  });

}

function exportexceloverview () {
  var amount = $("#amountmonthform").val();
  var url = base_url + 'search/ajax_export_overview';
  $.ajax({
    method: "POST",
    url: url,
    data: { 
      amount: amount, 
    }
  })
    .done(function( link ) {
      window.open(link , '_blank');
  });

}

var trsg = $('#trsgform').val();
var amountmonth = $('#amountmonthform').val();
var status = $('#statusform').val();
var url = base_url + "/search/ajax_get_debt_customer";
var querystring = "?trsg=" + trsg + "&amountmonth=" + amountmonth + "&status=" + status;

var table = $('#example').DataTable({
  "processing": true,
  "pageLength": 10,
  "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
  "searching": false
});