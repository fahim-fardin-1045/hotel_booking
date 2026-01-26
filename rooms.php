<?php 
require "includes/header.php"; 
require "config/config.php";

// Get hotel id from URL
$id = $_GET['id'] ?? null;

if(!$id){
    echo "<script>window.location.href='".APPURL."/index.php'</script>";
    exit;
}

// Fetch rooms for this hotel
$stmt = $conn->prepare("SELECT * FROM rooms WHERE hotel_id = :hotel_id AND status = 1");
$stmt->execute([':hotel_id' => $id]);
$getAllRooms = $stmt->fetchAll(PDO::FETCH_OBJ);
?>

<!-- HERO -->
<section class="hero-wrap hero-wrap-2" style="background-image: url('<?php echo APPURL; ?>/images/image_2.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-9 ftco-animate text-center">
        <p class="breadcrumbs mb-2">
          <span class="mr-2"><a href="<?php echo APPURL; ?>">Home <i class="fa fa-chevron-right"></i></a></span>
          <span>Rooms <i class="fa fa-chevron-right"></i></span>
        </p>
        <h1 class="mb-0 bread">Apartment Rooms</h1>
      </div>
    </div>
  </div>
</section>

<!-- ROOMS -->
<section class="ftco-section bg-light">
  <div class="container-fluid px-md-0">
    <div class="row no-gutters">

      <?php if(count($getAllRooms) > 0): ?>
        <?php foreach($getAllRooms as $room): ?>
          <div class="col-lg-6">
            <div class="room-wrap d-md-flex">
              <!-- Room Image -->
              <a href="<?php echo APPURL; ?>/rooms/room-single.php?id=<?php echo $room->id; ?>" 
                 class="img" 
                 style="background-image: url('<?php echo ROOMSIMAGES . '/' . htmlspecialchars($room->image); ?>');">
              </a>

              <!-- Room Info -->
              <div class="half left-arrow d-flex align-items-center">
                <div class="text p-4 p-xl-5 text-center">
                  <p class="mb-0">
                    <span class="price mr-1">$<?php echo number_format($room->price,2); ?></span> 
                    <span class="per">per night</span>
                  </p>
                  <h3 class="mb-3">
                    <a href="<?php echo APPURL; ?>/rooms/room-single.php?id=<?php echo $room->id; ?>">
                      <?php echo htmlspecialchars($room->name); ?>
                    </a>
                  </h3>
                  <ul class="list-accomodation">
                    <li><span>Max:</span> <?php echo htmlspecialchars($room->num_persons); ?> Persons</li>
                    <li><span>Size:</span> <?php echo htmlspecialchars($room->size); ?> m²</li>
                    <li><span>View:</span> <?php echo htmlspecialchars($room->view); ?></li>
                    <li><span>Bed:</span> <?php echo htmlspecialchars($room->num_beds); ?></li>
                  </ul>

                  <!-- Room Utilities -->
                  <?php
                  $utilStmt = $conn->prepare("
                      SELECT u.name, u.icon
                      FROM utilities u
                      INNER JOIN room_utilities ru ON u.id = ru.utility_id
                      WHERE ru.room_id = :room_id
                  ");
                  $utilStmt->execute([':room_id' => $room->id]);
                  $utilities = $utilStmt->fetchAll(PDO::FETCH_OBJ);
                  ?>
                  <?php if($utilities): ?>
                  <div class="room-utilities mt-2 d-flex justify-content-center flex-wrap">
                    <?php foreach($utilities as $util): ?>
                      <div class="m-1" data-toggle="tooltip" title="<?php echo htmlspecialchars($util->name); ?>">
                        <?php if($util->icon): ?>
                          <i class="<?php echo htmlspecialchars($util->icon); ?> fa-2x"></i>
                        <?php else: ?>
                          <span class="badge badge-info"><?php echo htmlspecialchars($util->name); ?></span>
                        <?php endif; ?>
                      </div>
                    <?php endforeach; ?>
                  </div>
                  <script>
                    $(function () {
                      $('[data-toggle="tooltip"]').tooltip()
                    })
                  </script>
                  <?php endif; ?>

                  <p class="pt-1">
                    <a href="<?php echo APPURL; ?>/rooms/room-single.php?id=<?php echo $room->id; ?>" 
                       class="btn-custom px-3 py-2">
                      View Room Details <span class="icon-long-arrow-right"></span>
                    </a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12 text-center">
          <h3>No rooms available for this hotel.</h3>
          <p><a href="<?php echo APPURL; ?>/index.php" class="btn btn-primary mt-3">Go Back Home</a></p>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>

<?php require "includes/footer.php"; ?>
