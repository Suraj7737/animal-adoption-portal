<?php
require_once 'config.php';

$search_term = trim($_GET['search'] ?? '');
$records = [];

if (!empty($search_term)) {
    // Prepared statement for secure search
    $sql = "SELECT id, adopter_name, animal_type, city, status, created_at 
            FROM enquiries 
            WHERE animal_type LIKE ? OR city LIKE ? OR adopter_name LIKE ?
            ORDER BY id DESC";

    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        $like = "%" . $search_term . "%";
        mysqli_stmt_bind_param($stmt, "sss", $like, $like, $like);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            $records[] = $row;
        }
        mysqli_stmt_close($stmt);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Enquiries - PawRescue</title>
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
        <h2>Search Adoption Enquiries</h2>
        
        <form action="search.php" method="GET" class="search-bar">
            <input type="text" name="search" placeholder="Search by animal, city, or name..." 
                   value="<?= htmlspecialchars($search_term, ENT_QUOTES, 'UTF-8') ?>" required>
            <button type="submit" class="btn">Search</button>
            <?php if (!empty($search_term)): ?>
                <a href="search.php" class="btn btn-secondary">Clear</a>
            <?php endif; ?>
        </form>

        <?php if (!empty($search_term)): ?>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Animal</th>
                        <th>City</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($records)): ?>
                        <?php foreach ($records as $row): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($row['adopter_name'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($row['animal_type'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($row['city'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><strong><?= htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8') ?></strong></td>
                                <td><?= htmlspecialchars(date('M d, Y', strtotime($row['created_at'])), ENT_QUOTES, 'UTF-8') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" style="text-align: center; color: #888;">No results found for "<?= htmlspecialchars($search_term, ENT_QUOTES, 'UTF-8') ?>".</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

</body>
</html>