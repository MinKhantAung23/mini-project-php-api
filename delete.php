<?php

header("Content-type: Application/json");

$dir = "records";

// echo json_encode($_SERVER);

if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    if (!empty($_GET["file"])) {
        if (file_exists($dir. "/". $_GET["file"])) {
            // $data = file_get_contents($dir. "/". $_GET["file"]);
            $data = unlink($dir. "/". $_GET["file"]);
            echo json_encode(["message" => "file deleted"]);
        } else {
            echo json_encode(["error" => "file not found"]);
        }
    }else {
        echo json_encode(["error" => "file is requested"]);
    }
};

