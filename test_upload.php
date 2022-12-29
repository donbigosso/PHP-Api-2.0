<?php


 if (isset($_FILES["file"])){
    $file = $_FILES['file'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];
    print_r("Uploading ".$fileName." message: ".$_POST['message']);
    $fileExt = explode(".",$fileName);
    $fileActualExt = strtolower(end($fileExt));
 
    $max_size_kb = 1200;
    $allowed = array('jpg','jpeg','png',"mp4","rar","zip","mov","mkv","docx", "mp3");
    $allowed_string = implode(", ",$allowed);
    if (in_array($fileActualExt, $allowed)){
        if ($fileError===0){
            if ($fileSize<$max_size_kb*1000){
                $fileNameNew = $fileName."_".uniqid('',true).".".$fileActualExt;
                $fileDestination = "./uploads/".$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                echo "File uploaded";
                
            } else {
                echo "The file is too big. Max size is: ".$max_size_kb."KB";
            }
        } else 
        {echo "Error uploading file...";        }
    }
    else {
        echo "Unsuported file type. Please upload one of the following: ".$allowed_string;
    }
 }
 else {
    echo "Error uploading file...";
 }
 ?>
