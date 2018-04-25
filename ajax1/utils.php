<?php 

function connecter_db()
{
	$cnx= new PDO("mysql:host=localhost;dbname=db2019","root","");
 $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
 return $cnx;
}
//ajout de produit
function ajouter_produit($libelle,$prix,$photo,$categorie_id)
{ 
	$cnx=connecter_db();
	$rp=$cnx->prepare("insert into produit (libelle,prix,photo,categorie_id) values(?,?,?,?)");
	$rp->execute(array($libelle,$prix,$photo,$categorie_id));
}

//ajout de contact
function ajouter_contact($sujet,$message)
{ 
	$cnx=connecter_db();
	$rp=$cnx->prepare("insert into contact (sujet,message) values(?,?)");
	$rp->execute(array($sujet,$message));
}

//ajout de categorie
function ajouter_categorie($nom,$photo)
{ 
	$cnx=connecter_db();
	$rp=$cnx->prepare("insert into categorie (nom,photo) values(?,?)");
	$rp->execute(array($nom,$photo));
}

//suppression dans une table par son id
function supprimer($id,$table)
{
	try{
	$cnx=connecter_db();
	$rp=$cnx->prepare("delete from $table where id=?");
	$rp->execute(array($id));
	}
	catch(PDOException $error){
die("erreur de suppression ".$error->getMessage());
	}

}
//modification de produit
function modifier_produit($id,$new_libelle,$new_prix,$new_photo,$categorie_id )
{
	$cnx=connecter_db();
	$rp=$cnx->prepare("update produit set libelle = ? , prix= ? , photo=? , categorie_id=?  where id=?");
	$rp->execute(array($new_libelle,$new_prix,$new_photo,$categorie_id,$id));
}
//modification de produit
function modifier_categorie($id,$new_nom,$new_photo )
{ try{
	$cnx=connecter_db();
	$rp=$cnx->prepare("update categorie set nom = ? , photo= ?  where id=?");
	$rp->execute(array($new_nom,$new_photo,$id));
}catch(PDOException $error){
die("erreur de modif cate ".$error->getMessage());
	}}
//recuperation de tous les produits
function recuperer_tous( $table)
{
	$cnx=connecter_db();
	$rp=$cnx->prepare("select * from $table order by id desc");
	$rp->execute(array());
	$data=$rp->fetchAll();
	return $data;
}
//recuperation de tous les produits
function recuperer_par( $condition,$table)
{
	$cnx=connecter_db();
	$rp=$cnx->prepare("select * from $table where $condition");
	$rp->execute(array());
	$data=$rp->fetchAll();
	return $data;
}
//recuperation d'une table par son id
function recuperer_par_id($id,$table )
{
	$cnx=connecter_db();
	$rp=$cnx->prepare("select * from $table where id = ?");
	$rp->execute(array($id));
	$data=$rp->fetch();
	return $data;
}
function charger($infos)
{
	extract($infos);//$name,$tmp_name,...(5 infos)
	//generer un nom aléatoire et unique
	$new_name=md5("test".date('Y_m_d_h_i_s')."_".rand(0,99))."_".$name;
	//deplacer le fichier temp vers sa destination  définitive
	$new_destination="uploads/".$new_name;
	$extension=pathinfo($name,PATHINFO_EXTENSION);
//taille en octect
$taille=filesize($tmp_name);

if($taille > 8000000){
die("fichier trop volumineux ,  la taille max est 8Mo");
}
$extension_autorise=array('jpg','png','jpeg','gif');
if (! in_array(strtolower($extension), $extension_autorise)) {
	die("type de fichier non autorisé (ce n'est une image)");
}
	move_uploaded_file($tmp_name, $new_destination);
return  $new_destination;
}

function get_count($table,$condition)
{
	$cnx=connecter_db();
	$rp=$cnx->prepare("select count(*) as nombre from $table where $condition");
	$rp->execute(array());
	$data=$rp->fetch();
	return $data['nombre'];
}
 ?>