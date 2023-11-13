<?php
    $servername='localhost';
    $username='root';
    $password='';
    $dbname = "tmsdata";
    $conn=mysqli_connect($servername,$username,$password,"$dbname");
    if(!$conn){
    ('Could not Connect MySql Server:' .mysql_error());
    }
?>