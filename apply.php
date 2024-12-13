<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit(); // Make sure to exit after the redirect
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job_id = $_POST['job_id'];
    $user_id = $_SESSION['user_id'];
    $resume = $_FILES['resume']['name'];

    // Upload Resume
    move_uploaded_file($_FILES['resume']['tmp_name'], "uploads/$resume");

    // Insert into Applications Table
    $stmt = $pdo->prepare("INSERT INTO applications (user_id, job_id, resume) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $job_id, $resume]);

    // Fetch Job and User Details
    $job_stmt = $pdo->prepare("SELECT * FROM jobs WHERE id = ?");
    $job_stmt->execute([$job_id]);
    $job = $job_stmt->fetch();

    $user_stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $user_stmt->execute([$user_id]);
    $user = $user_stmt->fetch();

    // Send Email Notification
    $to = $user['email'];
    $subject = "Application Submitted for " . $job['title'];
    $message = "Dear " . $user['name'] . ",\n\nThank you for applying for the job: " . $job['title'] . " at " . $job['company'] . ".\n\nYour application has been received successfully.\n\nBest Regards,\nJob Application Platform";
    $headers = "From: admin@jobplatform.com";

    if (mail($to, $subject, $message, $headers)) {
        echo "Application submitted and email notification sent!";
    } else {
        echo "Application submitted but email notification failed!";
    }
}
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
<form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="job_id" value="<?= $_GET['job_id']; ?>">
    Upload Resume: <input type="file" name="resume" required><br>
    <input type="submit" value="Apply">
</form>
