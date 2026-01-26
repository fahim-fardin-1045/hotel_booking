<?php 
require "includes/header.php"; 
require "config/config.php"; 
?>

<!-- HERO SECTION -->
<section class="hero-wrap hero-wrap-2" style="background-image: url('images/image_2.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-9 ftco-animate text-center">
        <p class="breadcrumbs mb-2">
          <span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span>
          <span>About Us <i class="ion-ios-arrow-forward"></i></span>
        </p>
        <h1 class="mb-0 bread">About Us</h1>
      </div>
    </div>
  </div>
</section>

<!-- ABOUT SERVICES SECTION -->
<section class="ftco-section bg-light">
  <div class="container">
    <div class="row d-flex">

      <?php
      // About services array
      $about_services = [
        [
          'title' => 'Map Direction',
          'map_embed' => '<div class="map-responsive">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.905745183342!2d90.4005578153991!3d23.7509052948439!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c7656e43db0f%3A0x9a7e0e6d2c02e13b!2sDhaka!5e0!3m2!1sen!2sbd!4v1600000000000!5m2!1sen!2sbd" 
                                    width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                          </div>',
          'desc' => 'Get precise directions and maps to reach our hotel with ease.'
        ],
        [
          'img' => 'images/services-2.jpg', 
          'title' => 'Accommodation Services', 
          'desc' => 'Premium rooms with all modern amenities for a comfortable stay.'
        ],
        [
          'img' => 'images/image_2.jpg', 
          'title' => 'Great Experience', 
          'desc' => 'Enjoy our facilities and services that guarantee a memorable experience.'
        ]
      ];

      foreach ($about_services as $service) : ?>
        <div class="col-md-4 d-flex align-items-stretch ftco-animate">
          <div class="services-wrap text-center w-100 d-flex flex-column">
            <?php if(isset($service['map_embed'])): ?>
              <?php echo $service['map_embed']; ?>
            <?php else: ?>
              <div class="img" style="background-image: url(<?php echo $service['img']; ?>); height: 250px;"></div>
            <?php endif; ?>
            <div class="media-body py-4 px-3 mt-auto">
              <h3 class="heading"><?php echo $service['title']; ?></h3>
              <p><?php echo $service['desc']; ?></p>
              <p><a href="#" class="btn btn-primary">Read more</a></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>

    </div>
  </div>
</section>

<!-- CSS -->
<style>
.map-responsive {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 ratio */
    height: 0;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0,0,0,0.2);
    margin-bottom: 15px;
}
.map-responsive iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
.services-wrap {
    display: flex;
    flex-direction: column;
    height: 100%;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
    background: #fff;
    transition: transform 0.3s ease;
}
.services-wrap:hover {
    transform: translateY(-5px);
}
.services-wrap .media-body {
    flex-grow: 1;
}
</style>


<!-- TESTIMONIALS SECTION -->
<section class="ftco-section testimony-section bg-light">
  <div class="container">
    <div class="row justify-content-center pb-5 mb-3">
      <div class="col-md-7 heading-section text-center ftco-animate">
        <h2>Happy Clients & Feedbacks</h2>
      </div>
    </div>
    <div class="row ftco-animate">
      <div class="col-md-12">
        <div class="carousel-testimony owl-carousel">
          <?php
          // Example testimonials array
          $testimonials = [
            ['img' => 'images/person_1.jpg', 'name' => 'Racky Henderson', 'position' => 'Father', 'text' => 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.'],
            ['img' => 'images/person_2.jpg', 'name' => 'Henry Dee', 'position' => 'Businesswoman', 'text' => 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.'],
            ['img' => 'images/person_3.jpg', 'name' => 'Mark Huff', 'position' => 'Businesswoman', 'text' => 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.'],
            ['img' => 'images/person_4.jpg', 'name' => 'Rodel Golez', 'position' => 'Businesswoman', 'text' => 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.'],
            ['img' => 'images/person_1.jpg', 'name' => 'Ken Bosh', 'position' => 'Businesswoman', 'text' => 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.']
          ];

          foreach ($testimonials as $testimony) : ?>
            <div class="item">
              <div class="testimony-wrap d-flex">
                <div class="user-img" style="background-image: url(<?php echo $testimony['img']; ?>);"></div>
                <div class="text pl-4">
                  <span class="quote d-flex align-items-center justify-content-center">
                    <i class="fa fa-quote-left"></i>
                  </span>
                  <p><?php echo $testimony['text']; ?></p>
                  <p class="name"><?php echo $testimony['name']; ?></p>
                  <span class="position"><?php echo $testimony['position']; ?></span>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ABOUT DETAIL & AMENITIES -->
<section class="ftco-section bg-light">
  <div class="container">
    <div class="row no-gutters">
      <div class="col-md-6 wrap-about">
        <div class="img img-2 mb-4" style="background-image: url(images/image_2.jpg);"></div>
        <h2>The most recommended vacation rental</h2>
        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts. One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
      </div>
      <div class="col-md-6 wrap-about ftco-animate">
        <div class="heading-section">
          <div class="pl-md-5">
            <h2 class="mb-2">What we offer</h2>
          </div>
        </div>
        <div class="pl-md-5">
          <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
          
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
            <div class="services-2 col-lg-6 d-flex w-100 mb-4">
              <div class="icon d-flex justify-content-center align-items-center">
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
    </div>
  </div>
</section>

<?php require "includes/footer.php"; ?>
