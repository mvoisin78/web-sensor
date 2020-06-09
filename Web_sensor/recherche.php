<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Accueil</title>
    <meta charset="UTF-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style2.css">  


    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>  
</head>
<body>
<?php
	require ('include/header.inc.php');
	headWeb("Index","Gestion de l'apprentissage","home","index");
?>
 <div class="page">
<section id="main">

<div class="searchbar">
                               
<div class="row">
  <div class="col-md-4 col-md-offset-4">
        <form action = "verif-form.php" method = "get">
        <input class="form-control form-control-md mr-3 w-75" type="text" placeholder="Rechercher un event..." aria-label="Search">
        <input class="btn btn-default" type = "submit" name = "s" value = "Rechercher">
  </form>
</div>
</div>

</div> 	



</section>
</div>
  

<?php
require("include/footer.inc.php");
  foot();
  ?>