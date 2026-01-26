<?php
require "../layouts/header.php";
require "../../config/config.php";

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Admin authentication
if (!isset($_SESSION['adminname'])) {
    echo "<script>window.location.href='" . ADMINURL . "/admins/login-admins.php';</script>";
    exit;
}

// Handle form submission
if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $icon = trim($_POST['icon']);
    $description = trim($_POST['description']);

    $errors = [];

    if (empty($name)) $errors[] = "Utility name is required.";
    if (empty($icon)) $errors[] = "Icon class is required.";
    if (empty($description)) $errors[] = "Description is required.";

    if (empty($errors)) {
        try {
            $insert = $conn->prepare("INSERT INTO utilities (name, icon, description) VALUES (:name, :icon, :description)");
            $insert->execute([
                ':name' => $name,
                ':icon' => $icon,
                ':description' => $description
            ]);

            echo "<script>alert('Utility added successfully'); window.location.href='show-utilities.php';</script>";
            exit;
        } catch (PDOException $e) {
            echo "<script>alert('Database Error: " . addslashes($e->getMessage()) . "');</script>";
        }
    } else {
        echo "<script>alert('" . addslashes(implode("\\n", $errors)) . "');</script>";
    }
}
?>

<div class="row mt-4">
    <div class="col-md-6 offset-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">Add Utility</h5>
                <form method="POST">
                    <div class="form-group mb-3">
                        <label>Utility Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter utility name" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Icon Class</label>
                        <input type="text" name="icon" class="form-control" placeholder="e.g., flaticon-first" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" placeholder="Enter utility description" rows="3" required></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Add Utility</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require "../layouts/footer.php"; ?>
