<?php
require_once 'config.php';

$message = '';
$is_success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adopter_name  = trim($_POST['adopter_name'] ?? '');
    $adopter_email = trim($_POST['adopter_email'] ?? '');
    $animal_type   = trim($_POST['animal_type'] ?? '');
    $city          = trim($_POST['city'] ?? '');
    $status        = 'Pending';

    // Server-side validation
    if (empty($adopter_name) || empty($adopter_email) || empty($animal_type) || empty($city)) {
        $message = "All fields are required.";
    } elseif (!filter_var($adopter_email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address.";
    } else {
        // Prepared statement using ? placeholders
        $sql = "INSERT INTO enquiries (adopter_name, adopter_email, animal_type, city, status) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssss", $adopter_name, $adopter_email, $animal_type, $city, $status);
            
            if (mysqli_stmt_execute($stmt)) {
                $message = "Adoption enquiry submitted successfully!";
                $is_success = true;
            } else {
                $message = "Failed to save enquiry. Please try again.";
            }
            mysqli_stmt_close($stmt);
        } else {
            $message = "Failed to prepare request.";
        }
    }
} else {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submission Status</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container" style="max-width: 500px; margin-top: 50px;">
    <div class="card" style="text-align: center;">
        <div class="alert <?= $is_success ? 'alert-success' : 'alert-danger' ?>">
            <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
        </div>
        <a href="index.php" class="btn">New Enquiry</a>
        <a href="view.php" class="btn btn-secondary">View All</a>
    </div>
</div>

</body>
</html>