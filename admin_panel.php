<?php
session_start();
include 'config.php';

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: admin_login.php"); 
    exit(); // Make sure to exit after the redirect
}

// Add Job Logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $company = $_POST['company'];
    $location = $_POST['location'];

    $stmt = $pdo->prepare("INSERT INTO jobs (title, description, company, location) VALUES (?, ?, ?, ?)");
    $stmt->execute([$title, $description, $company, $location]);

    echo "Job added successfully!";
}

// Fetch Jobs
$stmt = $pdo->query("SELECT * FROM jobs");
$jobs = $stmt->fetchAll();
?>

<?php include 'navbar.php'; ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Job Listings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        </div>
</body>
</html>
<body class="bg-dark text-light">
    <div class="container mt-5">
        <h1 class="text-center text-info mb-4">Admin Panel</h1>
        

        <h2 class="text-warning">Add New Job</h2>
        <form method="POST" class="mb-4">
            <div class="mb-3">
                <label for="title" class="form-label">Job Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="company" class="form-label">Company</label>
                <input type="text" name="company" id="company" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" name="location" id="location" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-info">Add Job</button>
        </form>

        <h2 class="text-warning">Posted Jobs</h2>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Company</th>
                    <th>Location</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jobs as $job): ?>
                    <tr>
                        <td><?= $job['id']; ?></td>
                        <td><?= htmlspecialchars($job['title']); ?></td>
                        <td><?= htmlspecialchars($job['description']); ?></td>
                        <td><?= htmlspecialchars($job['company']); ?></td>
                        <td><?= htmlspecialchars($job['location']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>