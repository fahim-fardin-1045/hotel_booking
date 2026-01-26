<footer class="footer">
    <div class="container">
        <div class="row">
            <!-- About Section -->
            <div class="col-md-6 col-lg-3 mb-md-0 mb-4">
                <h2 class="footer-heading"><a href="<?php echo APPURL; ?>" class="logo">Vacation Rental</a></h2>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                <a href="<?php echo APPURL; ?>/about.php">Read more <span class="fa fa-chevron-right" style="font-size: 11px;"></span></a>
            </div>

            <!-- Services Section -->
            <div class="col-md-6 col-lg-3 mb-md-0 mb-4">
                <h2 class="footer-heading">Services</h2>
                <ul class="list-unstyled">
                    <li><a href="#" class="py-1 d-block">Map Direction</a></li>
                    <li><a href="#" class="py-1 d-block">Accommodation Services</a></li>
                    <li><a href="#" class="py-1 d-block">Great Experience</a></li>
                    <li><a href="#" class="py-1 d-block">Perfect Central Location</a></li>
                </ul>
            </div>

            <!-- Tag Cloud -->
            <div class="col-md-6 col-lg-3 mb-md-0 mb-4">
                <h2 class="footer-heading">Tag Cloud</h2>
                <div class="tagcloud">
                    <?php
                    $tags = ["apartment","home","vacation","rental","rent","house","place","drinks"];
                    foreach($tags as $tag){
                        echo '<a href="#" class="tag-cloud-link">'.$tag.'</a> ';
                    }
                    ?>
                </div>
            </div>

            <!-- Subscribe & Social -->
            <div class="col-md-6 col-lg-3 mb-md-0 mb-4">
                <h2 class="footer-heading">Subscribe</h2>
                <form action="#" class="subscribe-form">
                    <div class="form-group d-flex">
                        <input type="email" class="form-control rounded-left" placeholder="Enter email address" required>
                        <button type="submit" class="form-control submit rounded-right"><span class="sr-only">Submit</span><i class="fa fa-paper-plane"></i></button>
                    </div>
                </form>

                <h2 class="footer-heading mt-5">Follow Us</h2>
                <ul class="ftco-footer-social p-0">
                    <li><a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a></li>
                    <li><a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a></li>
                    <li><a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"></span></a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="w-100 mt-5 border-top py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-8">
                    <p class="copyright mb-0">
                        &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Made with <i class="fa fa-heart" aria-hidden="true"></i> by 
                        <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
                    </p>
                </div>
                <div class="col-md-6 col-lg-4 text-md-right">
                    <p class="mb-0 list-unstyled">
                        <a class="mr-md-3" href="#">Terms</a>
                        <a class="mr-md-3" href="#">Privacy</a>
                        <a class="mr-md-3" href="#">Compliances</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Loader -->
<div id="ftco-loader" class="show fullscreen">
    <svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/>
    </svg>
</div>

<!-- Scripts -->
<script src="<?php echo APPURL; ?>/js/jquery.min.js"></script>
<script src="<?php echo APPURL; ?>/js/jquery-migrate-3.0.1.min.js"></script>
<script src="<?php echo APPURL; ?>/js/popper.min.js"></script>
<script src="<?php echo APPURL; ?>/js/bootstrap.min.js"></script>
<script src="<?php echo APPURL; ?>/js/jquery.easing.1.3.js"></script>
<script src="<?php echo APPURL; ?>/js/jquery.waypoints.min.js"></script>
<script src="<?php echo APPURL; ?>/js/jquery.stellar.min.js"></script>
<script src="<?php echo APPURL; ?>/js/jquery.animateNumber.min.js"></script>
<script src="<?php echo APPURL; ?>/js/bootstrap-datepicker.js"></script>
<script src="<?php echo APPURL; ?>/js/jquery.timepicker.min.js"></script>
<script src="<?php echo APPURL; ?>/js/owl.carousel.min.js"></script>
<script src="<?php echo APPURL; ?>/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo APPURL; ?>/js/scrollax.min.js"></script>

<!-- Google Maps -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"></script>
<script>
function initMap() {
    var hotelLocation = {lat: 23.8103, lng: 90.4125}; // Replace with your hotel's location
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: hotelLocation
    });
    var marker = new google.maps.Marker({
        position: hotelLocation,
        map: map
    });
}
</script>

<script src="<?php echo APPURL; ?>/js/main.js"></script>
</body>
</html>
