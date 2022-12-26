<?php


 if (isset($_FILES["file"])){
    print_r($_FILES["file"]);
 }
 else {
    echo "Error uploading file...";
 }
 ?>
