<?php
session_start();

$servername = "db";
$username = "root";
$password = "azerty";
$database = "partieldocker";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $database);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';

    // Vérifications des prénoms et noms spéciaux
    if ($firstName === 'CR' && $lastName === '7') {
        header("Location: /cr7.php");
        exit();
    } elseif ($firstName === 'KM' && $lastName === '10') {
        header("Location: /km10.php");
        exit();
    } elseif ($firstName === 'LM' && $lastName === '10') {
        header("Location: /lm10.php");
        exit();
    } elseif ($firstName === 'R' && $lastName === '9') {
        header("Location: /r9.php");
        exit();
    } elseif ($firstName === 'R' && $lastName === '10') {
        header("Location: /r10.php");
        exit();
    } elseif ($firstName === 'KB' && $lastName === '9') {
        header("Location: /kb9.php");
        exit();
    }

    if (!empty($firstName) && !empty($lastName)) {
        // Vérifier si l'utilisateur existe déjà
        $checkStmt = $conn->prepare("SELECT * FROM users WHERE first_name = ? AND last_name = ?");
        $checkStmt->bind_param("ss", $firstName, $lastName);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows > 0) {
            $message = "Cet utilisateur existe déjà.";
        } else {
            // Insérer le nouvel utilisateur
            $stmt = $conn->prepare("INSERT INTO users (first_name, last_name) VALUES (?, ?)");
            $stmt->bind_param("ss", $firstName, $lastName);
            if ($stmt->execute()) {
                $message = "L'utilisateur a été créé avec succès.";
            } else {
                $message = "Erreur : " . $stmt->error;
            }
            $stmt->close();
        }
        $checkStmt->close();
    } else {
        $message = "Un nom et un prénom sont requis.";
    }
}

$conn->close();

$_SESSION['message'] = $message;

header("Location: /message.php");
exit();
?>
