<?php
// add_to_watchlist.php
session_start();
include 'db.php';
 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $data = json_decode(file_get_contents('php://input'), true);
    $user_id = $_SESSION['user_id'];
    $content_id = $data['content_id'];
 
    try {
        $stmt = $pdo->prepare("INSERT INTO watchlist (user_id, content_id) VALUES (?, ?)");
        $stmt->execute([$user_id, $content_id]);
        echo json_encode(['message' => 'Added to watchlist']);
    } catch (PDOException $e) {
        echo json_encode(['message' => 'Already in watchlist']);
    }
}
?>
