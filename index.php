<?php
include 'config.php'; // Database connection

try {
    // Fetch jobs from the database
    $stmt = $pdo->query("SELECT * FROM jobs");
    $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Failed to fetch jobs: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
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
<body class="bg-light">
    <div class="container mt-5">
        

        <!-- Job Listings -->
        <h1 class="text-center text-primary mb-4">Available Jobs</h1>
        <div class="row">
            <?php if (!empty($jobs)): ?>
                <?php foreach ($jobs as $job): ?>
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($job['title']); ?></h5>
                                <p class="card-text"><?= htmlspecialchars($job['description']); ?></p>
                                <p class="text-muted"><strong>Company:</strong> <?= htmlspecialchars($job['company']); ?></p>
                                <p class="text-muted"><strong>Location:</strong> <?= htmlspecialchars($job['location']); ?></p>
                                
                                <!-- Button Linking Example -->
                                <button onclick="location.href='apply.php?job_id=<?= $job['id']; ?>'" class="btn btn-primary">
                                    Apply Now
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center text-muted">No jobs available at the moment.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
