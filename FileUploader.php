<?php
    class FileUploader {
        public function check_file() {
        
                try {
                    
                    if(isset($_FILES["file"])){
                        return true;
                    }
                    else {throw new Exception("Uploading file failed. File does not exist. ");}
                }
                catch (Exception $e) {
                    echo 'Error: ',  $e->getMessage();
                }
           
        }
       
        public function get_file_ID(){
            if ($this->check_file()){
                return $_POST['fileID'];
            }
        }

        public function get_task(){
            if ($this->check_file()){
                return $_POST['task'];
            }
        }

        public function check_if_ID_in_list($list){
            if(gettype($list)==="array"){
                if(in_array($this->get_file_ID(), $list)){
                    return true;
                }
                else {
                    return false;;
                }
            }
            else {
                echo "File list is not valid...";
            }

        }

        public function save_upl_file_under_name($file_name="noname.tmp", $max_kb_size=1000, $upl_folder="./uploads/"){
            if($this->check_file()){
                $file = $_FILES['file'];
                $fileTmpName = $file['tmp_name'];
                $fileSize = $file['size'];
                $fileError = $file['error'];
                if ($fileError===0){
                    if ($fileSize<$max_kb_size*1000){
                        //code here
                        $fileDestination = $upl_folder.$file_name;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        echo "File uploaded";
                    }
                    else {echo "The file is too big. Max size is: ".$max_kb_size."KB";}
                }
                else {echo "Error with uploading file";}

            }

        }
    }

   
?>