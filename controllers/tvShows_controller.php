<?php

function tvShowDetailsPage($id) {
    // phpinfo();
    $url = 'https://api.themoviedb.org/3/tv/' .$id. '?api_key=7d64a9ed6d8e781b0d44e1b214945855&language=fr';


    $json = '{"foo-bar": 12345}';
    $obj = json_decode($json);
    

    $jsonResponse = file_get_contents($url);

    $phpResponse = json_decode($jsonResponse);


    // $request = new http\Client\Request("GET", $url, ["User-Agent"=>"MyAgent/0.1"]);
  
    // $request->setOptions(["timeout" => 1]);

    // $client = new http\Client;
    // $client->enqueue($request)->send();

    // $response = $client->getResponse();



    // $response = http_get($url, array(
    //                 'headers' => array(
    //                     'Accept' => 'application/json'
    //                 )
    //             ), $infos);

    // print_r($infos);

    require_once('view/tvShowDetails_view.php');
}