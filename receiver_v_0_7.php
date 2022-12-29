<?php
    include "FileHandler.php";
    include "DataHandler.php";
    include "FileUploader.php";
    $dh = new DataHandler;
    $fu = new FileUploader;
    $fh= new FileHandler;
    $received_data = file_get_contents("php://input");
    $decoded_data = $dh->decode_data( $received_data);
    $file_name = $decoded_data["filename"];
    $file_list_file = "file_list.json";
    $file_folder = "./uploads";
    $data_to_save=$dh->encode_data($decoded_data["data"]);
    $file_list_exists = $fh -> check_if_file_exists("file_list.json");
   
    
    function get_file_list($file_list, $file_handler) {
        if($file_handler -> check_if_file_exists($file_list)){
            return file_get_contents($file_list);
        }
        else {echo "Error reading file list. ";}
    }
    //check task
    if (isset($decoded_data["task"])){
        $task=$decoded_data["task"];
    }
    else {
        $task = $fu->get_task();
    }
    //take action basing on task
    if ($task ==="write_to_file"){
        
        $fh->write_to_file($data_to_save,  $file_name);
        echo "Data successfuly saved to: ".$file_name;
    }
    else if($task === "uploadFile"){
        //get file list and its keys
        try {
            $file_list_keys = $dh->get_keys($dh-> decode_data(get_file_list($file_list_file, $fh)));
            $file_in_the_list = $fu->check_if_ID_in_list($file_list_keys);  //true or false
            if($file_in_the_list){
                echo "File found in the list with ID: ".$fu->get_file_ID()." ";
                //get the filename
                $file_list= $dh-> decode_data(get_file_list($file_list_file, $fh));
                $file_id = $fu->get_file_ID();
                $server_file_name = $file_list[$file_id];
                print_r("File name: ".$server_file_name." ");
             
                $folder_content = scandir($file_folder);
                print_r($file_folder." contains: ");
                print_r($folder_content);
                $fu->save_upl_file_under_name($server_file_name); 

            }
            else if (!$file_in_the_list){
                echo "File not found in the file list. Adding a new file.";
            }
            else {throw new Exception("Error checking the file status in the file list.");}
        
        }
        catch(Exception $e) {
            echo  $e->getMessage();
           
        } 
   
       
    }
    else {echo "Error: Task not recognized.";}
?>