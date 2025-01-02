<?php

try{
    $conn = new PDO('mysql:host=localhost;dbname=gestionnaire_avance','root','');
    echo "hello i am connected";
}catch(PDOException $e){
 echo "not connect ";
}
?>