<?php session_start();
include 'utils.php';
check($_SESSION['email'],$_SESSION['passe']);
if($_SESSION['groupe']!="prof"){
header('location:login.php?cn=nogroupe');
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>vip</title>
</head>
<body>
	bienvenue dans vip
	
</body>
</html>