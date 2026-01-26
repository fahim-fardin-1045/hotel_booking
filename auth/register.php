<?php
require "../includes/header.php";
require "../config/config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* Redirect if already logged in */
if (isset($_SESSION['username'])) {
    header("Location: " . APPURL);
    exit;
}

/* Handle form submission */
if (isset($_POST['submit'])) {

    if (
        empty($_POST['username']) ||
        empty($_POST['email']) ||
        empty($_POST['password'])
    ) {
        echo "<script>alert('One or more fields are empty');</script>";
    } else {

        $username = trim($_POST['username']);
        $email    = trim($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        /* Check for existing user */
        $check = $conn->prepare(
            "SELECT id FROM users WHERE username = :username OR email = :email"
        );
        $check->execute([
            ":username" => $username,
            ":email"    => $email
        ]);

        if ($check->rowCount() > 0) {
            echo "<script>alert('Username or Email already exists');</script>";
        } else {

            $insert = $conn->prepare(
                "INSERT INTO users (username, email, mypassword)
                 VALUES (:username, :email, :mypassword)"
            );

            $insert->execute([
                ":username"   => $username,
                ":email"      => $email,
                ":mypassword" => $password
            ]);

            header("Location: login.php");
            exit;
        }
    }
}
?>



?>

    <div class="hero-wrap js-fullheight" style="background-image: url('<?php echo APPURL; ?>/images/image_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-md-7 ftco-animate">
          	<!-- <h2 class="subheading">Welcome to Vacation Rental</h2>
          	<h1 class="mb-4">Rent an appartment for your vacation</h1>
            <p><a href="#" class="btn btn-primary">Learn more</a> <a href="#" class="btn btn-white">Contact us</a></p> -->
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-book ftco-no-pt ftco-no-pb">
    	<div class="container">
	    	<div class="row justify-content-middle" style="margin-left: 397px;">
	    		<div class="col-md-6 mt-5">
						<form action="register.php" method="POST" class="appointment-form" style="margin-top: -568px;">
							<h3 class="mb-3">Register</h3>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
			    					    <input type="text" name="username" class="form-control" placeholder="Username">
			    				    </div>
								</div>
                <div class="col-md-12">
									<div class="form-group">
			    					    <input type="text" name="email" class="form-control" placeholder="Email">
			    				    </div>
								</div>
                <div class="col-md-12">
									<div class="form-group">
			    					    <input type="password" name="password" class="form-control" placeholder="Password">
			    				    </div>
								</div>
								
							
							
								<div class="col-md-12">
                  <div class="form-group">
                     <input type="submit" name="submit" value="Register" class="btn btn-primary py-3 px-4">
                 </div>
								</div>
							</div>
	    			</form>
	    		</div>
	    	</div>
	    </div>
    </section>

<?php require "../includes/footer.php"; ?>
