<?php

class TvShowsController {


    public function tvShowsPage() {
        require_once('view/tvShows_view.php');
    }


    public function tvShowDetailsPage($id) {
        $url = 'https://api.themoviedb.org/3/tv/' .$id. '?api_key=7d64a9ed6d8e781b0d44e1b214945855&language=fr';
    
        $jsonResponse = file_get_contents($url);
        $phpResponse = json_decode($jsonResponse);
    
        require_once('view/tvShowDetails_view.php');
    }
}

