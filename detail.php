<?php

header("Content-type: Application/json");

$dir = "records";

if (!empty($_GET["file"])) {
    if (file_exists($dir. "/". $_GET["file"])) {
        $data = file_get_contents($dir. "/". $_GET["file"]);
        echo $data;
    } else {
        header("HTTP/1.1 404 Not found");
        echo json_encode(["error" => "file not found"]);
    }
    
}else {
    echo json_encode(["error" => "file is requested"]);
}