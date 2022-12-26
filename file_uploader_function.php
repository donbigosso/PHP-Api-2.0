<?php
     ini_set('upload_max_filesize', '30M');   
    if (isset($_POST['submit'])) {
     $file = $_FILES['file'];
     $fileName = $file['name'];
     $fileTmpName = $file['tmp_name'];
     $fileSize = $file['size'];
     $fileError = $file['error'];
     $fileType = $file['type'];
     print_r($file);
     $fileExt = explode(".",$fileName);
     $fileActualExt = strtolower(end($fileExt));
     $allowed = array('jpg','jpeg','png',"mp4","rar","zip","mov","mkv","docx");
    if (in_array($fileActualExt, $allowed)){
        if ($fileError===0){
            if ($fileSize<2000000000){
                $fileNameNew = $fileName."_".uniqid('',true).".".$fileActualExt;
                $fileDestination = "../uploads/".$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                header("Location: ../index.php?uploadsuccess");
                
            } else {
                echo "Plik jest za duży...";
            }
        } else 
        {echo "Błąd przy wgrywaniu pliku";        }
    }
    else {
        echo "Niedozwolony typ pliku...";
    }
 }
 else {
     echo "Błąd wgrywania...";
 } 
 ?>

