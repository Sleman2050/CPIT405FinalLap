<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once __DIR__ . '/../db/Database.php';

$database = new Database();
$db = $database->connect();


$data = json_decode(file_get_contents("php://input"));


error_log("Update Request: " . print_r($data, true));

if (!empty($data->id) && !empty($data->title) && !empty($data->url)) {
    try {
        $query = "UPDATE bookmark SET title = :title, URL = :url WHERE id = :id";
        $stmt = $db->prepare($query);

        $stmt->bindParam(':id', $data->id);
        $stmt->bindParam(':title', $data->title);
        $stmt->bindParam(':url', $data->url);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Bookmark updated successfully."]);
        } else {
            echo json_encode(["message" => "Failed to update bookmark."]);
        }
    } catch (PDOException $e) {
        error_log("Database Update Error: " . $e->getMessage());
        echo json_encode(["message" => "Database error occurred.", "error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["message" => "Missing required parameters id, title, or url."]);
    error_log("Missing Parameters: " . print_r($data, true));
}
?>
