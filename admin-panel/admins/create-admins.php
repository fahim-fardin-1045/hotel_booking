<?php
require "../layouts/header.php";
require "../../config/config.php";

// Protect admin route
if (!isset($_SESSION['adminname'])) {
    echo "<script>window.location.href='" . ADMINURL . "/admins/login-admins.php';</script>";
    exit;
}

// Handle form submission
if (isset($_POST['submit'])) {

    $adminname = trim($_POST['adminname']);
    $email     = trim($_POST['email']);
    $password  = trim($_POST['password']);

    // Validation
    if (empty($adminname) || empty($email) || empty($password)) {
        echo "<script>alert('One or more inputs are empty');</script>";
    } else {

        // Check if admin already exists
        $check = $conn->prepare("SELECT id FROM admins WHERE email = :email");
        $check->execute([':email' => $email]);

        if ($check->rowCount() > 0) {
            echo "<script>alert('Admin with this email already exists');</script>";
        } else {

            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert admin
            $insert = $conn->prepare(
                "INSERT INTO admins (adminname, email, mypassword)
                 VALUES (:adminname, :email, :mypassword)"
            );

            $insert->execute([
                ":adminname"  => $adminname,
                ":email"      => $email,
                ":mypassword" => $hashedPassword
            ]);

            // Redirect after success
            echo "<script>
                alert('Admin created successfully');
                window.location.href='admins.php';
            </script>";
            exit;
        }
    }
}
?>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Create Admin</h5>

                <form method="POST" action="create-admins.php">

                    <div class="form-outline mb-4">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="text" name="adminname" class="form-control" placeholder="Username" required>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">
                        Create Admin
                    </button>

                </form>

            </div>
        </div>
    </div>
</div>

<?php require "../layouts/footer.php"; ?>
