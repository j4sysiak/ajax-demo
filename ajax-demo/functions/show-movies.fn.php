<?php

function showMovies($data) {
    global $db, $userID;
   
    switch($data) {
        case "favs":
            $stmt = $db->prepare("SELECT * FROM movies
                WHERE `movie_id` IN (
                    SELECT `movie_id` FROM `favourites`
                        WHERE `favourites`.`user_id` = ?
                )
            ORDER BY `title`");

            $stmt->bind_param('i', $userID);
            break;
        
        case "non_favs":
            $stmt = $db->prepare("SELECT * FROM movies
                WHERE `movie_id` NOT IN (
                    SELECT `movie_id` FROM `favourites`
                        WHERE `favourites`.`user_id` = ?
                )
            ORDER BY `title`");

            $stmt->bind_param('i', $userID);
            break;
    }
    
    $stmt->bind_result($id, $title, $description);
    $stmt->execute();
    
    $output = "";
    
    while ($stmt->fetch()) {
        $title = htmlentities($title, ENT_QUOTES, "UTF-8");
        $description = htmlentities($description, ENT_QUOTES, "UTF-8");

        $output .= "\t<li class='movie_list' id='movie_$id'>$title</li>\n";
        }
   
    $stmt->close();
    return($output);
}

?> 