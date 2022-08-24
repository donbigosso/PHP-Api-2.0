<?php
    include "FileHandler.php";
    include "DataHandler.php";
    $dh = new DataHandler;
    $received_data = file_get_contents("php://input");
    $decoded_data = $dh->decode_data( $received_data);
    $file_name = $decoded_data["filename"];
    $data_to_save=$dh->encode_data($decoded_data["data"]);

    $task=$decoded_data["task"];
    
    if ($task ==="write_to_file"){
        $fh= new FileHandler;
        $fh->write_to_file($data_to_save,  $file_name);
        echo "Data successfuly saved to: ".$file_name;
    }
    else {echo "Error: Task not recognized.";}
?>