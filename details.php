<?php 
include 'utils.php';
extract($_GET);//$p
if (isset($p)) {
  $produit=recuperer_par_id($p, "produit");
}
 ?>
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <title>détails du produits</title>

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
      <?php //include 'slider.php' ?>
  <!--/ slider -->

  <div class="clearfix"></div>
      <section class="marge contenu b container">
        <h2 class="titre"><?php echo $produit['libelle'] ?> </h2>
      <div class="col-sm-6 b">
        
        <img src="<?php echo $produit['photo'] ?>" width="100%" alt="">
      </div>
      <div class="col-sm-6 b">
        
        <div class="prix">
          <?php echo $produit['prix'] ?> MAD
        </div>
         <div class="prix">
          <?php if( $produit['qtestock'] >0)
echo "En stock";
else echo "En Rupture de stock";
          ?> 
        </div>
      </div>
        

      </section>

    <div class="container">
      <h2> autres produits dans la même catégorie :</h2>
      <?php 
       $categorie_id=$produit['categorie_id'];
      $produits_same= recuperer_par("categorie_id=$categorie_id", "produit");
     
       ?>

       <?php foreach ($produits_same as $p): ?>
<?php if ($produit['id']!=$p['id']):
$aleatoire=rand(0, get_count("produit","categorie_id=    $categorie_id")-1);

 ?>
   <div class="col-sm-2 b">
           <img src="<?php   echo  $p['photo'] ?>" width="100%">
         </div>
<?php endif ?>
        
       
       <?php endforeach ?>

    </div>
    <div class="container">
      <h2>aléatoire</h2>

<?php for($i=0;$i<get_count("produit","categorie_id=    $categorie_id");$i++){ 
?>
<?php  $alea=rand(0,get_count("produit","categorie_id=    $categorie_id")); ?>
<div class="col-sm-4">
<img src="<?php echo $produits_same[$alea]['photo'] ?>" alt="">
</div>
<?php } ?>
    </div> 
     <?php include 'footer.php' ?>


      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="js/bootstrap.min.js"></script>
    </body>
  </html>