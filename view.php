<?php
require_once 'config.php';

// Handle status update (Update Feature)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
    $status = trim($_POST['status'] ?? '');
    $allowed = ['Pending', 'Under Review', 'Approved', 'Rejected'];

    if ($id && in_array($status, $allowed, true)) {
        $update_sql = "UPDATE enquiries SET status = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $update_sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "si", $status, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }
}

// Fetch all enquiries
$sql = "SELECT id, adopter_name, adopter_email, animal_type, city, status, created_at FROM enquiries ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Enquiries - PawRescue</title>
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
    <div class="card">
        <h2>All Adoption Enquiries</h2>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Animal</th>
                    <th>City</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Update Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($row['adopter_name'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($row['adopter_email'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($row['animal_type'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($row['city'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><strong><?= htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8') ?></strong></td>
                            <td><?= htmlspecialchars(date('M d, Y', strtotime($row['created_at'])), ENT_QUOTES, 'UTF-8') ?></td>
                            <td>
                                <form action="view.php" method="POST">
                                    <input type="hidden" name="action" value="update">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') ?>">
                                    <select name="status" onchange="this.form.submit()" style="padding: 4px; font-size: 0.85rem;">
                                        <?php foreach (['Pending', 'Under Review', 'Approved', 'Rejected'] as $opt): ?>
                                            <option value="<?= $opt ?>" <?= $row['status'] === $opt ? 'selected' : '' ?>><?= $opt ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="8" style="text-align: center; color: #888;">No records found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>