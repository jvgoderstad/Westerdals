<?php
//REQUIREMENTS FOR ALL PAGES
require 'functions.php';
//REQUIREMENTS FOR ALL PAGES

drawHeader($db);

echo'<div id="layout">
    <div id="main">
        <div class="header">
            <h1>Utvalg</h1>
            <h2>Alle utvalgene på Westerdal</h2>
        </div>

        <div class="content">';
            if (isset($_GET['selection'])){
    if ($_GET['selection'] == 'mineutvalg'){
        echo "<br/>";
        echo '<section id="boxContainer">';
            drawAllUtvalgOnUserid($db, 'box', $_SESSION['id']);
        echo '</section>';
    }
    if ($_GET['selection'] == 'aktiviteter'){
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
			echo '
        </div>
    </div>
</div>';
?>
