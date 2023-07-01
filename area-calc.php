<?php

header("Content-type:Application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $result = [
        "width" => $_POST["width"]."ft",
        "breadth" => $_POST["breadth"]."ft",
        "area" => ($_POST["width"] * $_POST["breadth"])."sqft",
    ];

    // print_r($_POST);

    $response = json_encode($result);

    $dir = "records";
    $photoDir = "photos";

    // store photos
    if (!file_exists($photoDir)) {
        mkdir($photoDir);
    };

    if ( !empty($_FILES) && $_FILES["photo"]["error"] === 0) {
        $newPhotoName = $photoDir. "/".uniqid()."-photo.". pathinfo($_FILES["photo"]["name"])["extension"];
        move_uploaded_file($_FILES["photo"]["tmp_name"],$newPhotoName);
        $result["photo"] = $newPhotoName;
    }

    // store data
    if (!file_exists($dir)){
        mkdir($dir);
    }

    $response = json_encode($result);
    $newFileName = $dir."/"."r"."-". uniqid()."-".time().".json";
    $file = fopen($newFileName, "w");
    fwrite($file, $response);
    fclose($file);

    header("HTTP/1.1 201 File Created");

    echo $response;

}