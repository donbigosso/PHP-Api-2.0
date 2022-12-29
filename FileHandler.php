<?php
    class FileHandler {
        public $source_file = null;
        public $destination_file = null;
        public function set_source($source){
            $this->source_file = $source;
        }
        public function set_destination($destination){
            $this->destination_file = $destination;
        }

        public function check_if_file_exists($file){
            $file_content = @file_get_contents($file);
            if($file_content){
                return true;
            }
            else {
                return false;
            }
        }
        public function get_file_content($file){
            try {
                $file_content = @file_get_contents($file);
                if($file_content){
                    return $file_content;
                }
                else {throw new Exception("Can't read the file. Please check if the file exists.");}
            
            }
            catch (Exception $e) {
                echo 'Error: ',  $e->getMessage();
            }
        }

        public function write_to_file($content, $file){
            
            try {
                $my_file = fopen($file, 'w') or die('There was an error when trying to write to: '.$file);
                fwrite($my_file, $content);
                fclose($my_file);
            }
            catch (Exception $e) {
                echo 'Error: ',  $e->getMessage();
            }

        }

        public function append_file ($content, $file){
            
            try {
                $my_file = fopen($file, 'a') or die('There was an error when trying append: '.$file);
                fwrite($my_file, $content);
                fclose($my_file);
            }
            catch (Exception $e) {
                echo 'Error: ',  $e->getMessage();
            }

        }

        

        
    }


?>