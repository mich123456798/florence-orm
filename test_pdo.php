<?php
try {
  # MySQL with PDO_MYSQL  
  $DBH = new PDO("mysql:host=localhost;dbname=florence", 'root', 'root');    
}  
catch(PDOException $e) {  
    echo $e->getMessage();  
}  

?>