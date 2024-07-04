<?php
session_start();
$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Message</h1>
        <?php if ($message): ?>
            <div class="message <?php echo strpos($message, 'succès') !== false ? 'success' : 'error'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <a href="http://localhost:8080">Retourner au formulaire</a>
    </div>
</body>
</html>
