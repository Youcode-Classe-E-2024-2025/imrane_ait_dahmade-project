<?php

try{
    $conn = new PDO('mysql:host=localhost;dbname=gestionnaire_avance','root','');
   
}catch(PDOException $e){
 echo "not connect ";
}
?>