<?php
require "includes/header.php";
require "config/config.php";

/* =========================
   FETCH ACTIVE HOTELS
========================= */
$hotelsStmt = $conn->prepare(
    "SELECT id, name, description, location, image
     FROM hotels
     WHERE status = 1
     ORDER BY id DESC"
);
$hotelsStmt->execute();
$allHotels = $hotelsStmt->fetchAll(PDO::FETCH_OBJ);

/* =========================
   FETCH ACTIVE ROOMS
========================= */
$roomsStmt = $conn->prepare(
    "SELECT id, name, image, num_persons, size, view, num_beds, price
     FROM rooms
     WHERE status = 1
     ORDER BY id DESC
     LIMIT 6"
);
$roomsStmt->execute();
$allRooms = $roomsStmt->fetchAll(PDO::FETCH_OBJ);
?>

<!-- HERO -->
<div class="hero-wrap js-fullheight" style="background-image: url('<?php echo APPURL; ?>/images/image_2.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center">
            <div class="col-md-7 ftco-animate">
                <h2 class="subheading">Welcome to Vacation Rental</h2>
                <h1 class="mb-4">Rent an apartment for your vacation</h1>
                <p>
                    <a href="<?php echo APPURL; ?>/about.php" class="btn btn-primary">Learn More</a>
                    <?php if(count($allHotels) > 0): ?>
                        <a href="<?php echo APPURL; ?>/rooms.php?id=<?php echo $allHotels[0]->id; ?>" class="btn btn-white">Book Apartment Now</a>
                    <?php else: ?>
                        <a href="<?php echo APPURL; ?>/contact.php" class="btn btn-white">Contact Us</a>
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- HOTELS SECTION -->
<section class="ftco-section ftco-services">
    <div class="container">
        <div class="row">
            <?php if(count($allHotels) > 0): ?>
                <?php foreach($allHotels as $hotel): ?>
                    <div class="col-md-4 d-flex services align-self-stretch px-4 ftco-animate">
                        <div class="d-block services-wrap text-center">
                            <div class="img" style="background-image: url('<?php echo HOTELSIMAGES; ?>/<?php echo htmlspecialchars($hotel->image); ?>'); height:200px; background-size:cover;"></div>
                            <div class="media-body py-4 px-3">
                                <h3><?php echo htmlspecialchars($hotel->name); ?></h3>
                                <p><?php echo htmlspecialchars($hotel->description); ?></p>
                                <p>Location: <?php echo htmlspecialchars($hotel->location); ?></p>
                                <p>
                                    <a href="<?php echo APPURL; ?>/rooms.php?id=<?php echo $hotel->id; ?>" class="btn btn-primary">View Rooms</a>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center w-100">No hotels available right now.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ROOMS SECTION -->
<section class="ftco-section bg-light">
    <div class="container-fluid px-md-0">
        <div class="row no-gutters justify-content-center pb-5">
            <div class="col-md-7 heading-section text-center">
                <h2>Apartment Rooms</h2>
            </div>
        </div>
        <div class="row no-gutters">
            <?php if(count($allRooms) > 0): ?>
                <?php foreach($allRooms as $room): ?>
                    <div class="col-lg-6">
                        <div class="room-wrap d-md-flex">
                            <a href="<?php echo APPURL; ?>/rooms/room-single.php?id=<?php echo $room->id; ?>" class="img" style="background-image: url('<?php echo ROOMSIMAGES; ?>/<?php echo htmlspecialchars($room->image); ?>');"></a>
                            <div class="half left-arrow d-flex align-items-center">
                                <div class="text p-4 p-xl-5 text-center">
                                    <h3>
                                        <a href="<?php echo APPURL; ?>/rooms/room-single.php?id=<?php echo $room->id; ?>">
                                            <?php echo htmlspecialchars($room->name); ?>
                                        </a>
                                    </h3>
                                    <ul class="list-accomodation">
                                        <li><span>Max:</span> <?php echo $room->num_persons; ?> Persons</li>
                                        <li><span>Size:</span> <?php echo $room->size; ?> m²</li>
                                        <li><span>View:</span> <?php echo htmlspecialchars($room->view); ?></li>
                                        <li><span>Bed:</span> <?php echo $room->num_beds; ?></li>
                                        <li><span>Price Per Night:</span> $<?php echo number_format($room->price,2); ?></li>
                                    </ul>
                                    <p class="pt-1">
                                        <a href="<?php echo APPURL; ?>/rooms/room-single.php?id=<?php echo $room->id; ?>" class="btn-custom px-3 py-2">View Room Details</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center w-100">No rooms available.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- CTA SECTION -->
<section class="ftco-intro" style="background-image: url('<?php echo APPURL; ?>/images/image_2.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 text-center">
                <h2>Ready to get started</h2>
                <p class="mb-4">It’s safe to book online with us.</p>
                <p>
                    <a href="<?php echo APPURL; ?>/about.php" class="btn btn-primary px-4 py-3">Learn More</a>
                    <a href="<?php echo APPURL; ?>/contact.php" class="btn btn-white px-4 py-3">Contact Us</a>
                </p>
            </div>
        </div>
    </div>
</section>

<?php require "includes/footer.php"; ?>
