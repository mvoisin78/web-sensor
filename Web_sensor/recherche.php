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
</head>
<body>
<?php
	require ('include/header.inc.php');
	headWeb("Index","Gestion de l'apprentissage","home","index");
?>
 <div class="page">
<section id="main">


<div class="searchbar">
                               

        <form action = "verif-form.php" method = "get">
   <input type = "search" name = "terme">
   <input type = "submit" name = "s" value = "Rechercher">
  </form>

        </div>
    </div> 	

</section>
</div>-->
  

<?php
require("include/footer.inc.php");
  foot();
  ?>