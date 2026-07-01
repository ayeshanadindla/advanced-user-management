<?php
include 'db_connect.php';

if(isset($conn)){
    echo "Database Connected Successfully!";
}else{
    echo "Connection Failed!";
}
?>