<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Adoption Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar">
    <div class="nav-container">
        <a href="index.php" class="brand">🐾 PawRescue</a>
        <div class="nav-links">
            <a href="index.php">Submit Enquiry</a>
            <a href="view.php">View Records</a>
            <a href="search.php">Search</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <h2>Submit Adoption Enquiry</h2>
        <p style="color: #666; margin-bottom: 15px; font-size: 0.9rem;">Fill in the form to register an adoption interest.</p>

        <!-- Submits form to save.php -->
        <form action="save.php" method="POST">
            <div class="form-group">
                <label for="adopter_name">Full Name *</label>
                <input type="text" id="adopter_name" name="adopter_name" placeholder="e.g. John Doe" required minlength="3">
            </div>

            <div class="form-group">
                <label for="adopter_email">Email Address *</label>
                <input type="email" id="adopter_email" name="adopter_email" placeholder="e.g. john@example.com" required>
            </div>

            <div class="form-group">
                <label for="animal_type">Preferred Animal *</label>
                <select id="animal_type" name="animal_type" required>
                    <option value="" disabled selected>Select an animal</option>
                    <option value="Dog">Dog</option>
                    <option value="Cat">Cat</option>
                    <option value="Rabbit">Rabbit</option>
                    <option value="Bird">Bird</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="city">City *</label>
                <input type="text" id="city" name="city" placeholder="e.g. Seattle" required>
            </div>

            <button type="submit" class="btn" style="width: 100%;">Submit Enquiry</button>
        </form>
    </div>
</div>

</body>
</html>