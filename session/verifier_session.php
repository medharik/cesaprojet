<?php 
session_start();
include 'utils.php';
extract($_POST);//$email,$passe
check($email, $passe);
if($_SESSION['groupe']=='prof')
header('location:prof.php');
if($_SESSION['groupe']=='admin')
header('location:admin.php');

 ?>