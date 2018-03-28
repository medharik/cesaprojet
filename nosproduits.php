<?php include 'utils.php' ?>
<?php 
extract($_GET);//$c
if(isset($c)){
$produits=recuperer_par("categorie_id=$c", "produit");
}else{
  $produits=recuperer_tous( "produit");

}

 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>cesa shop</title>

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
  
  <!--   header -->
   <?php include 'header.php' ?>
<!-- / header -->
<!-- menu -->
   <?php include 'menusite.php' ?>
 <!--/ menu -->
    <!-- slider -->
    <?php include 'slider.php' ?>
<!--/ slider -->

<div class="clearfix"></div>
<!-- contenu -->
    <section class="marge contenu b container">
      <h2 class="titre">Nos produits </h2>
<?php  ?>
<?php foreach ($produits as $p): ?>
   <div class="categorie col-md-3 b" >
      <div class="tof b">
      <a href="details.php?p=<?php echo $p['id'] ?>">
        <img src="<?php echo $p['photo']  ?>" alt="" class="img-responsive">
      </a>


      </div> 
      <div class="info"><?php echo $p['libelle'] ?>
      <br> <a class="btn btn-success" href="details.php?p=<?php echo $p['id'] ?>">Plus de détails</a></div>
      </div>

<?php endforeach ?>
      



    </section>
   <!-- / contenu -->
   <?php include 'footer.php' ?>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>