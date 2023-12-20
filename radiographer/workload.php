<?php
require '../koneksi/koneksi.php';
session_start();

// --------------------------------

if ($_SESSION['level'] == "radiographer") {
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html>

  <head>
    <title>Workload | Radiographer</title>
    <?php include('head.php'); ?>
    <style>
      @media only screen and (max-width: 800px) {
        .menu-size2 {
          visibility: hidden;
        }
      }

      @media only screen and (max-width: 768px) {
        .footerindex {
          position: fixed;
        }
      }

      @keyframes blinkCito {
        0% {
          background-color: red;
        }

        100% {
          background-color: white;
        }
      }

      .blinking-cito {
        /* animation: blinkCito 1.5s infinite; */
        background-color: red;
      }

      @keyframes blinkThreeHour {
        0% {
          background-color: orange;
        }

        100% {
          background-color: white;
        }
      }

      .blinking-3-hour {
        /* animation: blinkThreeHour 1.5s infinite; */
        background-color: orange;
      }

      @keyframes blinkSixHour {
        0% {
          background-color: yellow;
        }

        100% {
          background-color: white;
        }
      }

      .blinking-6-hour {
        /* animation: blinkSixHour 1.5s infinite; */
        background-color: #caca12;
      }

      @keyframes blinkTwelveHour {
        0% {
          background-color: green;
        }

        100% {
          background-color: white;
        }
      }

      .blinking-12-hour {
        /* animation: blinkTwelveHour 1.5s infinite; */
        background-color: green;
      }

      @keyframes blinkTwentyFourHour {
        0% {
          background-color: blue;
        }

        100% {
          background-color: white;
        }
      }

      .blinking-24-hour {
        /* animation: blinkTwentyFourHour 1.5s infinite; */
        background-color: blue;
      }

      .table .penawaran-a{
        color: #fff;
        font-weight: bold;
      }

      .notif-blink{
        padding: 15px 0px;
  border-radius: 5px;
      }
      
    </style>
    <meta http-equiv="refresh" content="500" />
  </head>

  <body>
    <?php include('../sidebar-index.php'); ?>
    <div class="container-fluid" id="main">
      <div class="row">
        <?php include('../workload-index.php'); ?>
      </div>
    </div>
    <br><br>
    <div class="footerindex">
      <div class="">
        <?php include('footer-itw.php'); ?>
      </div>
    </div>
    <?php include('script-footer.php'); ?>
    <script>
      $(document).ready(function() {
        $("li[data-target='#service']").addClass("active");
        $("ul[id='service'] li[id='workload1']").addClass("active");
        $("li[data-target='#service'] a i").css('color', '#bdbdbd');
      });
    </script>
  </body>

  </html>
<?php } else {
  header("location:../index.php");
} ?>