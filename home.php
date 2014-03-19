<?php
//REQUIREMENTS FOR ALL PAGES
require 'functions.php';
//REQUIREMENTS FOR ALL PAGES

drawHeader($db);
if (isset($_GET['selection'])){
    if ($_GET['selection'] == 'mineutvalg'){
        echo "<br/>";
        echo '<section id="boxContainer">';
            drawAllUtvalgOnUserid($db, 'box', $_SESSION['id']);
        echo '</section>';
    }
    if ($_GET['selection'] == 'aktiviteter'){
        echo '<section id="boxContainer">';
            drawAllArrangementOnUserid($db, $class, $_SESSION['id']);
        echo '</section>';
    	echo "Mine Utvalg:";
        echo "<br/>";
    	echo "Alle Utvalg:";
        echo "<br/>";
        echo '<section id="boxContainer">';
            drawAllArrangementThumbnail($db, 'box');
        echo '</section>';
    }
} else {
    echo "<br/>";
    echo '<section id="boxContainer">';
        drawAllUtvalgThumbnail($db, 'box');
    echo '</section>';
}
?>
