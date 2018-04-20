<?php 
session_start();
include_once 'utils.php';
check($_SESSION['email'], $_SESSION['passe']);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>

<a href="">Consulter</a>
<?php if ($_SESSION['groupe']=='admin'): ?>
<a href="">Supprimer</a>
<a href="">Modifier</a>
<?php endif ?>

	
</body>
</html>