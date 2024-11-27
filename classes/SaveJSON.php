<?php
  if(isset($_POST['categories'])) {

    echo "got it";
    $json = $_POST['categories'];
    var_dump(json_decode($json, true));
  } else {
    echo "Noooooooob";
  }
?>