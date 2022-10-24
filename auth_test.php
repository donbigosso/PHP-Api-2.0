<?php
include "AuthenticationHandler.php";
$auth_han = new AuthenticationHandler;
$received_data = "php://input";
$cred_file= "userData.json";
$username = $auth_han -> decode_data($received_data)[0];
$password = $auth_han -> decode_data($received_data)[1];
//write respons to frontend
echo $auth_han->return_json_response ($cred_file, $username, $password);


?>