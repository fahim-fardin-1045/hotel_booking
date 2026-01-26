<?php 
session_start();

// Base URL for admin panel
define("ADMINURL", "http://localhost/hotel-booking/admin-panel");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 4 -->
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo ADMINURL; ?>/styles/style.css" rel="stylesheet">

    <!-- jQuery and Bootstrap JS -->
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<div id="wrapper">
    <nav class="navbar header-top fixed-top navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#">LOGO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" 
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarText">
          <?php if(isset($_SESSION['adminname'])) : ?>
          <ul class="navbar-nav side-nav">
            <li class="nav-item">
              <a class="nav-link" style="margin-left: 20px;" href="<?php echo ADMINURL; ?>">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo ADMINURL; ?>/admins/admins.php" style="margin-left: 20px;">Admins</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo ADMINURL; ?>/hotels-admins/show-hotels.php" style="margin-left: 20px;">Hotels</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo ADMINURL; ?>/rooms-admins/show-rooms.php" style="margin-left: 20px;">Rooms</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo ADMINURL; ?>/bookings-admins/show-bookings.php" style="margin-left: 20px;">Bookings</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo ADMINURL; ?>/utilities-admins/show-utilities.php" style="margin-left: 20px;">Utilities</a>
            </li>
          </ul>
          <?php endif; ?>

          <ul class="navbar-nav ml-md-auto d-md-flex">
            <?php if(!isset($_SESSION['adminname'])) : ?> 
              <li class="nav-item">
                  <a class="nav-link" href="<?php echo ADMINURL; ?>/admins/login-admins.php">Login</a>
              </li>
            <?php else : ?>
              <li class="nav-item">
                  <a class="nav-link" href="<?php echo ADMINURL; ?>">Home</a>
              </li>
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <?php echo $_SESSION['adminname']; ?>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="<?php echo ADMINURL; ?>/admins/logout.php">Logout</a>
                  </div>
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid" style="margin-top: 80px;">
