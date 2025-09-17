
<?php
// db.php
// Database connection file. Assuming host is a cloud MySQL like PlanetScale. Replace 'host' if needed.
 
$host = 'localhost';  // Change to actual host, e.g., 'aws.connect.psdb.cloud' if PlanetScale
$dbname = 'dblzrzdeyzq2sm';
$username = 'uei4bkjtcem6s';
$password = 'wmhalmspfjgz';
 
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?
