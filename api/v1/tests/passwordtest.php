<?php 

$password = "teste";

$pass_encrypt = password_hash($password, PASSWORD_DEFAULT);

echo $pass_encrypt;

 ?>