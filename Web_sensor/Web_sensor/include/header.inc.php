<?php
function headWeb($val,$desc,$icon ="cog",$active){
    echo"<header>";
        
    echo"<div style=\"text-align:center; padding-bottom: 40px; padding-top: 10px;\">
    <h1 style=\"color:white; font-family:Palatino, URW Palladio L, serif;\"> Web Sensor</h1>";

        echo"<div class=\"barre\" style=\"padding-bottom:1px;\">";
        echo"<nav>";
        echo"<ul>";
            echo" <li><a href=\"index.php\">Accueil</a></li>";
            echo"<li><a href=\"recherche.php\">Recherche</a></li>";
        echo"<li><a href=\"comparaison.php\">Comparaison</a></li>";
                    /*echo" <li><a href=\"essaye.php\">ess</a></li>";*/

            echo"</ul>";        
        echo"</nav>";   
echo"</div>";
echo"</div>";
    echo"</header>";
}
?>
