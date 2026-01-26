<?php 
require "../layouts/header.php";
require "../../config/config.php";

if (isset($_SESSION['adminname'])) {
    header("Location: " . ADMINURL);
    exit;
}

if (isset($_POST['submit'])) {

    if (empty($_POST['email']) || empty($_POST['password'])) {
        echo "<script>alert('One or more inputs are empty')</script>";
    } else {

        $email = trim($_POST['email']);
        $password = $_POST['password'];

        // ✅ SECURE prepared statement
        $stmt = $conn->prepare("SELECT * FROM admins WHERE email = :email");
        $stmt->execute([
            ':email' => $email
        ]);

        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && password_verify($password, $admin['mypassword'])) {

            // Set session
            $_SESSION['adminname'] = $admin['adminname'];
            $_SESSION['id'] = $admin['id'];

            header("Location: " . ADMINURL);
            exit;

        } else {
            echo "<script>alert('Email or password is wrong')</script>";
        }
    }
}
?>

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mt-5">Admin Login</h5>

        <form method="POST" action="login-admins.php">

          <div class="form-outline mb-4">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
          </div>

          <div class="form-outline mb-4">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
          </div>

          <button type="submit" name="submit" class="btn btn-primary mb-4">
            Login
          </button>

        </form>

      </div>
    </div>
  </div>
</div>

<?php require "../layouts/footer.php"; ?>
