<?php
$servername = "db";
$username = "root";
$password = "rootpassword";
$database = "exampledb";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $database);


// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully to the database.";
echo "       Bienvenue SUR LE BACK-END";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';

    if (!empty($firstName) && !empty($lastName)) {
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name) VALUES (?, ?)");
        $stmt->bind_param("ss", $firstName, $lastName);
        if ($stmt->execute()) {
            echo "L'utilisateur à été crée avec succées.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Un nom et un prénom sont requis.";
    }
}

$conn->close();
?>
