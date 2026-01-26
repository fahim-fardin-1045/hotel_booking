<?php require "includes/header.php"; ?>

<!-- HERO SECTION -->
<section class="hero-wrap hero-wrap-2" style="background-image: url('images/image_2.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-9 ftco-animate text-center">
        <p class="breadcrumbs mb-2">
          <span class="mr-2"><a href="<?php echo APPURL; ?>">Home <i class="fa fa-chevron-right"></i></a></span>
          <span>Services <i class="fa fa-chevron-right"></i></span>
        </p>
        <h1 class="mb-0 bread">Services</h1>
      </div>
    </div>
  </div>
</section>

<!-- SERVICES SECTION -->
<section class="ftco-section bg-light">
  <div class="container">
    <div class="row">

      <!-- MAP DIRECTION SERVICE -->
      <div class="col-md-4 d-flex services align-self-stretch px-4 ftco-animate">
        <div class="services-wrap text-center w-100">
          <div style="height:200px;">
            <iframe 
              src="https://www.google.com/maps?q=23.8103,90.4125&z=15&output=embed" 
              width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
          </div>
          <div class="media-body py-4 px-3">
            <h3 class="heading">Map Direction</h3>
            <p>Get precise directions to reach our hotel with ease and convenience.</p>
            <p>
              <a href="https://www.google.com/maps/dir/?api=1&destination=23.8103,90.4125" target="_blank" class="btn btn-primary">
                Open in Google Maps
              </a>
            </p>
          </div>
        </div>
      </div>

      <!-- ACCOMMODATION SERVICE -->
      <div class="col-md-4 d-flex services align-self-stretch px-4 ftco-animate">
        <div class="services-wrap text-center w-100">
          <div class="img" style="background-image: url(images/services-2.jpg); height:200px; background-size: cover;"></div>
          <div class="media-body py-4 px-3">
            <h3 class="heading">Accommodation Services</h3>
            <p>We provide premium rooms with all the modern amenities for your comfortable stay.</p>
            <p><a href="#" class="btn btn-primary">Read more</a></p>
          </div>
        </div>
      </div>

      <!-- GREAT EXPERIENCE SERVICE -->
      <div class="col-md-4 d-flex services align-self-stretch px-4 ftco-animate">
        <div class="services-wrap text-center w-100">
          <div class="img" style="background-image: url(images/image_2.jpg); height:200px; background-size: cover;"></div>
          <div class="media-body py-4 px-3">
            <h3 class="heading">Great Experience</h3>
            <p>Enjoy our facilities and services that guarantee a memorable experience during your stay.</p>
            <p><a href="#" class="btn btn-primary">Read more</a></p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- AMENITIES SECTION -->
<section class="ftco-section bg-light ftco-no-pt">
  <div class="container">
    <div class="row justify-content-center pb-5 mb-3">
      <div class="col-md-7 heading-section text-center ftco-animate">
        <h2>Amenities</h2>
      </div>
    </div>
    <div class="row">
      <?php
      $amenities = [
        ['icon' => 'flaticon-diet', 'title' => 'Tea Coffee', 'desc' => 'Fresh tea and coffee available for all guests.'],
        ['icon' => 'flaticon-workout', 'title' => 'Hot Showers', 'desc' => 'Enjoy hot showers with modern fittings.'],
        ['icon' => 'flaticon-diet-1', 'title' => 'Laundry', 'desc' => 'Laundry services available on request.'],
        ['icon' => 'flaticon-first', 'title' => 'Air Conditioning', 'desc' => 'Stay cool and comfortable with air conditioning.'],
        ['icon' => 'flaticon-first', 'title' => 'Free Wifi', 'desc' => 'High-speed WiFi available throughout the hotel.'],
        ['icon' => 'flaticon-first', 'title' => 'Kitchen', 'desc' => 'Access to fully-equipped kitchen facilities.'],
        ['icon' => 'flaticon-first', 'title' => 'Ironing', 'desc' => 'Ironing services for your convenience.'],
        ['icon' => 'flaticon-first', 'title' => 'Lockers', 'desc' => 'Secure lockers available for your belongings.']
      ];

      foreach ($amenities as $amenity) : ?>
        <div class="services-2 col-md-3 d-flex w-100 ftco-animate mb-4">
          <div class="icon d-flex justify-content-center align-items-center mr-3" style="width:42px;height:42px;border-radius:50%;background-color:#e63946;color:#fff;">
            <span class="<?php echo $amenity['icon']; ?>"></span>
          </div>
          <div class="media-body pl-3">
            <h3 class="heading"><?php echo $amenity['title']; ?></h3>
            <p><?php echo $amenity['desc']; ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require "includes/footer.php"; ?>
