$(document).ready(function() {
    $requestRunning = false;
    $(document).on('click', '.non_favs .movie_list', function() {
        if ($requestRunning) {
            return; // Don't do anything if an AJAX request is running
        }

        $id = ($(this).attr('id').split("_"));
        $id = $id[1];
        $title = $(this).text();
        $this = $(this);
        
        $.ajax({
            url: "ajax/add-favs.ajax.php",
            type: "POST",
            data: {
                'user_id' : $userID,
                'movie_id' : $id
            }, // End data
            'beforeSend': function(){
                $requestRunning = true;
                $this.remove();
            }, // End beforeSend
            'success': function() {
                $requestRunning = false;
                $(".favs ul").append("<li class='movie_list' id='movie_" + $id + "'>" + $title + "</li>");
                $(".favs li#movie_" + $id).draggable({
                   helper: 'clone'            
                });                
            } // End success
        }); // End AJAX
        
    }); // End movie_list click function
}); // End document ready

