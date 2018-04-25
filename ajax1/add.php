<?php 	
include_once 'utils.php';
extract($_POST);
sleep(3);
ajouter_contact($sujet, $message);
echo "ok";

 ?>