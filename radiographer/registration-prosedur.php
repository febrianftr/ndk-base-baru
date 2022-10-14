<?php

require 'function_radiographer.php';

//fetch.php
if (isset($_POST["action"])) { ?>

  <?php
  $query = $_POST["query"];
  $query2 = "SELECT * FROM xray_price WHERE type = '$query' GROUP BY main_prosedur ORDER BY main_prosedur ASC";
  $result2 = mysqli_query($conn, $query2);
  ?>

  <!-- <option value="" >---PILIH PROSEDUR---</option> -->
  <?php while ($row2 = mysqli_fetch_array($result2)) { ?>
    <!-- <optgroup label="<?php echo $row2['main_prosedur']; ?>"> -->
    <option value="<?php echo $row2["main_prosedur"]; ?>"><?php echo $row2["main_prosedur"]; ?></option>
    <!-- </optgroup> -->
  <?php } ?>

<?php } ?>