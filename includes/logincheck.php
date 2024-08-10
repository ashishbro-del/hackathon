<?php
session_start();

if(!isset($_SESSION['id'])|| !isset($_SESSION['email'])){
 header('Location:login.php?err=Login please');
}   
?>