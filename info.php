<?php 

echo "checks safe mode...<br>";

if( ini_get('safe_mode') ){
   echo "safe mode is on...";
}else{
   echo "safe mode is off...";
}

 ?>