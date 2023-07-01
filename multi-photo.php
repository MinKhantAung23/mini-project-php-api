<?php

header("Content-type:Application/json");

$dir = "photos";
$baseUrl = "http://". $_SERVER["HTTP_HOST"]."/";
$response = [];

foreach($_FILES["photos"]["tmp_name"] as $key=>$photo){
    $newName = $dir."/". uniqid().".". pathinfo($_FILES["photos"]["name"][$key])["extension"];
    if (move_uploaded_file($photo, $newName)) {
        array_push($response,$baseUrl.$newName);
    }
}

echo json_encode($response);