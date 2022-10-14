<?php
require '../koneksi/koneksi.php';
session_start();

if ($_SESSION['level'] == "admin") {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php include('head.php'); ?>
    <title>Home | radiology</title>

  </head>
 <body>

<?php include('menu-bar.php'); ?><br>
<nav aria-label="breadcrumb">
          <ol class="breadcrumb1 breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Query</li>
          </ol>
        </nav>
 
    <!-- ---------------------------------chart--------------------- -->
    

    <!-- //////content home/////////////// -->
  <?php include('../query.php'); ?>
    <!-- //////end content home/////////////// -->
        <?php include('script-footer.php'); ?>

       
  </body>
  </html>
  <script>
  $('#From').datetimepicker({
    timepicker : false,
    format : 'Y-m-d'
  });
  $('#to').datetimepicker({
    timepicker : false,
    format : 'Y-m-d'
  });
</script>
<script>
$(document).ready(function(){

  $('.cboxtombol').click(function() {
        $('.cbox').prop('checked', this.checked);
    });

    $('.cboxtombolpay').click(function() {
        $('.cboxpay').prop('checked', this.checked);
    });
  $('#range').click(function(){
    $('#purchase_order').html("<div class='preloader-css'><span></span><span></span><span></span><span></span><span></span></div>");
    var From = $('#From').val();
    var to = $('#to').val();
    var keyword = $('#keyword').val();
    var keyword_mrn = $('#keyword_mrn').val();
    var keyword_acc = $('#keyword_acc').val();
    var modality = get_filter('checkbox');
    var payment = get_filter('checkbox');
    if(From != '' && to != '' && modality !='')
    {
      $.ajax({
        url:"prosescari.php",
        method:"POST",
        data:{From:From, to:to, keyword:keyword, keyword_mrn:keyword_mrn,keyword_acc:keyword_acc, modality:modality, payment:payment},
        success:function(data)
        {
          $('#purchase_order').html(data);
        }
      });
    }
    else
    {
      alert("Please Select Modality");
    }
  });
  function get_filter(class_name)
      {
          var filter = [];
          $('#'+class_name+':checked').each(function(){
              filter.push($(this).val());
          });
          return filter;
    }
    $('.common_selector').click(function(){
          purchase_order();
  });
});
</script> 
   <?php } else {header("location:../index.php");} ?>