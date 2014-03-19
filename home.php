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
        echo '<section id="arrContainer">';
    	if (isset($_SESSION['id'])){
    		echo "Påmeldte arrangementer:";
            drawAllArrangementOnUserid($db, $_SESSION['id']);
        	echo "<br/>";
        	echo "<br/>";
    		echo "Alle Arrangementer:";
    	}
        echo "<br/>";
            drawAllArrangementThumbnail($db, 'box');
        echo '</section>';
    }
} else {
    echo "<br/>";
    echo '<div id="boxContainer"><span id="centerFloats">';
        drawAllUtvalgThumbnail($db, 'boxCon');
    echo '</span></div>';
}
?>
