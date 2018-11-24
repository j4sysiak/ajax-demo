<?php

set_include_path ('./php-includes' . PATH_SEPARATOR . './functions');

require_once 'connect.inc.php';
require_once 'get-variables.inc.php';
require_once 'head.inc.php';
require_once 'show-movies.fn.php';

$favsList = showMovies('favs');
$nonfavsList = showMovies('non_favs');

?>

    <body>
        <div class="favs">
            <h2>Favourites</h2>
            <ul>
                <?php echo $favsList;?>
            </ul>
        </div>

        <div class="non_favs">
            <h2>Non-favourites</h2>
            <ul>
                <?php echo $nonfavsList;?>
            </ul>
        </div>        

        <div class="clear"></div>
        <div class="trash"></div>
        
    </body>
</html>