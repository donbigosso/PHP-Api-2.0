<?php

    class AuthenticationHandler {
        public function get_file_content($file){
            try {
                $file_content = @file_get_contents($file);
                if($file_content){
                    return $file_content;
                }
                else {throw new Exception("Error reading user data...");}
            
            }
            catch (Exception $e) {
                echo 'Error: ',  $e->getMessage();
            }
        }

        public function decode_data($file){
            $data = $this -> get_file_content($file);
            if($data) {
                try {
                    
                    $json_content  = json_decode($data, TRUE);
                    if($json_content){
                        return $json_content;
                    }
                    else {throw new Exception("Data is not a valid json. Can't decode. Please check it.");}
                }
                catch (Exception $e) {
                    echo 'Error: ',  $e->getMessage();
                }
            }
        }

        public function check_name ($file, $name){
          try{  
            $user_data_array = $this -> decode_data($file);
            $user_found = array(false,"User not found");
            if  ($user_data_array){
                foreach ($user_data_array as $index=>$user_data){
                    if ($user_data["name"]===$name){
                        $user_found = array(true, $index);
                    }
                }
                return $user_found;
            }
            else{
                throw new Exception("Error reading user data.");
            }
          }
          catch (Exception $e) {
            echo 'Error: ',  $e->getMessage();
            }
        }
        public function verify_password ($file, $name, $password){
            try {
                $password_veriffication =array(false,"Error with authentication...");
                $check_name_result=$this-> check_name($file, $name);
                if ($check_name_result){
                    if ($check_name_result[0]===true){
                        $user_data_array = $this -> decode_data($file);
                        if ( $user_data_array[$check_name_result[1]]["pass"]===$password){
                            $password_veriffication =array(true,"Password correct!");
                        }
                        else {
                            $password_veriffication =array(false,"Password incorrect...");
                        }
                    }
                    else {
                        $password_veriffication =array(false,"User not found...");
                    }
                }
                return $password_veriffication;
            }
            catch (Exception $e) {
                echo 'Error: ',  $e->getMessage();
                }

        }

        public function return_json_response($file, $name, $password){
            
            
            try {
                $data = $this->  verify_password ($file, $name, $password);
                $encoded_data = json_encode($data, JSON_UNESCAPED_UNICODE);
                return $encoded_data;
            }
            catch (Exception $e) {
                echo 'Error: ',  $e->getMessage();
            }
        }

    };
?>