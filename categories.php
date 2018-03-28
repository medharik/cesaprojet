<?php 
include 'utils.php';
$btn="ajouter";

//pour ajouter
if(isset($_POST) && isset($_FILES['photo']) && $_POST['ok']=="ajouter" ){
extract($_POST);//$nom
$infos=$_FILES['photo'];
$chemin=charger($infos);
ajouter_categorie($nom,$chemin);
header("location:categories.php");
}
extract($_GET);//$ids ou $ide
if(isset($ids)){
  supprimer($ids, "categorie");
 } 
 //si on veut editer (préparer la modif)
if (isset($ide)) {
  $ligne=recuperer_par_id($ide, "categorie");
$btn="modifier";
}

//si on veut modifier
if(isset($_POST) && isset($_FILES['photo']) && $_POST['ok']=="modifier" ){
extract($_POST);//$nom
$infos=$_FILES['photo'];
$chemin=charger($infos);
modifier_categorie($id, $nom, $chemin);
header("location:categories.php");
}

 ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>catégories </title>

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
  <label class="col-md-4 control-label" for="nom">Nom:</label>  
  <div class="col-md-4">
  <input id="nom" name="nom" value="<?php if(isset($ligne)) echo $ligne['nom'] ?>" type="text" placeholder="" class="form-control input-md" required="">
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




	<table class="table table-striped">
            <thead>
              <tr>
                <th>id</th>
                <th>Nom</th>
                <th>Photo</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
<?php 
  $categories=recuperer_tous( "categorie");
 ?>

 <?php foreach ($categories as $c): ?>
 	 <tr>
                <td><?php echo $c['id'] ?></td>
                <td><?php echo $c['nom'] ?></td>
<td>
<a href="produits.php?cid=<?php echo $c['id'] ?>">
  <img src="<?php echo $c['photo'] ?>" alt="" class="img-responsive"            >
</a>
              </td>
                <td><a onclick="return confirm('voulez vous vraiment supprimer cet élément?') " href="categories.php?ids=<?php echo $c['id'] ?>" class="btn btn-danger">Supprimer</a>
                	<a href="categories.php?ide=<?php echo $c['id'] ?>" class="btn btn-warning">modifier</a>
                  <a href="produits.php?cid=<?php echo $c['id'] ?>" class="btn btn-info">Afficher les produits</a>


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