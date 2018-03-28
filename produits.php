<?php 
include 'utils.php';
$btn="ajouter";

//pour ajouter
if(isset($_POST) && isset($_FILES['photo']) && $_POST['ok']=="ajouter" ){
extract($_POST);//$nom
$infos=$_FILES['photo'];
$chemin=charger($infos);
ajouter_produit($libelle, $prix, $chemin, $categorie_id);
header("location:produits.php");
}
extract($_GET);//$ids ou $ide
if(isset($ids)){
  supprimer($ids, "produit");
 } 
 //si on veut editer (préparer la modif)
if (isset($ide)) {
  $ligne=recuperer_par_id($ide, "produit");
$btn="modifier";
}

//si on veut modifier
if(isset($_POST) && isset($_FILES['photo']) && $_POST['ok']=="modifier" ){
extract($_POST);//$nom
$infos=$_FILES['photo'];
$chemin=charger($infos);
modifier_produit($id, $libelle, $prix, $chemin, $categorie_id);
header("location:produits.php");
}

$produits=recuperer_tous("produit");
extract($_GET);
if(isset($cid)){
$produits=recuperer_par("categorie_id=$cid", "produit");


}

 ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>produits </title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
  	<?php  include 'menu.php'; ?>
<div class="container">
  <div class="col-md-8 col-sm-8 center-zone" >
 <form class="form-horizontal" action="<?php echo basename(__FILE__) ?>" method="post" enctype="multipart/form-data">
<fieldset>

<!-- Form Name -->


<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="photo">Photo :</label>
  <div class="col-md-4">
    <input id="photo" name="photo" class="input-file" type="file" required="">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="libelle">Libellé:</label>  
  <div class="col-md-4">
  <input id="libelle" name="libelle" value="<?php if(isset($ligne)) echo $ligne['libelle'] ?>" type="text" placeholder="" class="form-control input-md" required="">
  <input type="hidden" name="id" value="<?php if(isset($ligne)) echo $ligne['id'] ?>">
    
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="prix">prix:</label>  
  <div class="col-md-4">
  <input id="prix" name="prix" value="<?php if(isset($ligne)) echo $ligne['prix'] ?>" type="text" placeholder="" class="form-control input-md" required="">
  <input type="hidden" name="id" value="<?php if(isset($ligne)) echo $ligne['id'] ?>">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="categorie_id">catégorie:</label>  
  <div class="col-md-4">
  <select id="categorie_id" name="categorie_id" class="form-control input-md" required="">
<?php 
$categories=recuperer_tous("categorie");
 ?>
 <?php foreach ($categories as $c): ?>
   <option value="<?php echo $c['id'] ?>" <?php if(isset($ligne) && $c['id']==$ligne['categorie_id']) echo "selected"  ?>  ><?php echo $c['nom'] ?></option>

 <?php endforeach ?>
  </select>
  <input type="hidden" name="id" value="<?php if(isset($ligne)) echo $ligne['id'] ?>">
    
  </div>
</div>
<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for=""></label>
  <div class="col-md-4">
    <input  type="submit" class="btn btn-primary" name="ok" value="<?php echo $btn ?>">
  </div>
</div>

</fieldset>
</form>

  </div>
  <div class="col-sm-4">
    <img src="<?php echo $ligne['photo'] ?>" alt="" class="img-responsive">
  </div>
</div>

<div class="container">


<div class="alert alert-info">
  Il y <?php echo get_count("produit",1) ?> produits
</div>

	<table class="table table-striped">
            <thead>
              <tr>
                <th>id</th>
                <th>Libellé</th>
                  <th>prix</th>
                    <th>catégorie</th>
                <th>Photo</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>

 <?php foreach ($produits as $p): ?>
 	 <tr>
                <td><?php echo $p['id'] ?></td>
                <td><?php echo $p['libelle'] ?></td>
                <td><?php echo $p['prix'] ?></td>
                <td><?php 
$categorie=recuperer_par_id($p['categorie_id'], "categorie");

                echo $categorie['nom'] ?></td>
                
                
<td><img src="<?php echo $p['photo'] ?>" alt="" class="img-responsive"
                ></td>
                <td><a onclick="return confirm('voulez vous vraiment supprimer cet élément?') "  href="produits.php?ids=<?php echo $p['id'] ?>" class="btn btn-danger" >Supprimer</a>
                	<a href="produits.php?ide=<?php echo $p['id'] ?>" class="btn btn-warning">modifier</a>


                </td>
              </tr>
 <?php endforeach ?>
             


              
            </tbody>
          </table>


</div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>



  </body>
</html>