<?php

header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}


include_once '../db/Database.php';
include_once '../models/Bookmark.php'; 


$database = new Database();
$dbConnection = $database->connect();


$bookmark = new Bookmark($dbConnection);


if (!isset($_GET['id'])) {
    http_response_code(422);
    echo json_encode(
        array('message' => 'Error: Missing required query parameter id.')
    );
    return;
}

$bookmark->setId($_GET['id']);

if ($bookmark->readOne()) {
    $result = array(
        'id' => $bookmark->getId(),
        'URL' => $bookmark->getURL(), 
        'title' => $bookmark->getTitle(), 
        'dateAdded' => $bookmark->getDateAdded()
    );
    echo json_encode($result);
} else {
    http_response_code(404);
    echo json_encode(
        array('message' => 'Error: No bookmark item was found')
    );
}