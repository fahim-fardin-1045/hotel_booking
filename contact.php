<?php 
require "includes/header.php"; 
require "config/config.php";

// Handle form submission
$form_success = '';
$form_error = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if($name && $email && $subject && $message){
        $data = "[".date("Y-m-d H:i:s")."] Name: $name, Email: $email, Subject: $subject, Message: $message\n";
        file_put_contents("contact_messages.txt", $data, FILE_APPEND);
        $form_success = "Your message was sent successfully!";
    } else {
        $form_error = "Please fill in all the fields.";
    }
}
?>

<!-- Hero Section -->
<section class="hero-wrap hero-wrap-2" style="background-image: url('<?php echo APPURL; ?>/images/image_2.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-9 ftco-animate text-center">
        <p class="breadcrumbs mb-2">
          <span class="mr-2"><a href="<?php echo APPURL; ?>">Home <i class="fa fa-chevron-right"></i></a></span> 
          <span>Contact <i class="fa fa-chevron-right"></i></span>
        </p>
        <h1 class="mb-0 bread">Contact Us</h1>
      </div>
    </div>
  </div>
</section>

<!-- Contact Section -->
<section class="ftco-section bg-light">
  <div class="container">
    <div class="row">

      <!-- Map -->
      <div class="col-md-8 mb-4">
        <div id="map" style="height: 400px; width: 100%; border-radius: 10px;"></div>
      </div>

      <!-- Info Box -->
      <div class="col-md-4 p-4 p-md-5 bg-white shadow-sm rounded mb-4">
        <h2 class="font-weight-bold mb-4">Let's get started</h2>
        <p>We are here to answer your questions and provide the best accommodation services.</p>
        <p><a href="<?php echo APPURL; ?>/rooms.php" class="btn btn-primary">Book Apartment Now</a></p>
      </div>

      <!-- Contact Form -->
      <div class="col-md-12">
        <div class="wrapper">
          <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
              <div class="contact-wrap w-100 p-md-5 p-4 bg-white shadow-sm rounded">
                <h3 class="mb-4">Get in Touch</h3>

                <?php if($form_error) : ?>
                  <div class="alert alert-danger"><?php echo $form_error; ?></div>
                <?php endif; ?>
                <?php if($form_success) : ?>
                  <div class="alert alert-success"><?php echo $form_success; ?></div>
                <?php endif; ?>

                <form method="POST" id="contactForm" name="contactForm" class="contactForm">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="message">Message</label>
                        <textarea name="message" class="form-control" id="message" cols="30" rows="5" placeholder="Message" required></textarea>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="submit" value="Send Message" class="btn btn-primary">
                      </div>
                    </div>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<?php require "includes/footer.php"; ?>

<!-- Google Maps Script -->
<script>
function initMap() {
    // Hotel coordinates
    var hotelLocation = {lat: 23.8103, lng: 90.4125}; // Replace with your hotel coordinates
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: hotelLocation
    });
    var marker = new google.maps.Marker({
        position: hotelLocation,
        map: map,
        title: "Vacation Rental"
    });
}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"></script>
