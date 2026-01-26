<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>

<?php 
if(!isset($_SESSION['adminname'])) {
    echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php'</script>";
    exit;
}

// Fetch bookings
$bookings = $conn->query("SELECT * FROM bookings");
$bookings->execute();
$allBookings = $bookings->fetchAll(PDO::FETCH_OBJ);
?>  

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-4 d-inline">Bookings</h5>

        <table class="table">
          <thead>
            <tr>
              <th>Check In</th>
              <th>Check Out</th>
              <th>Email</th>
              <th>Phone Number</th>
              <th>Full Name</th>
              <th>Room Name</th>
              <th>Booking Status</th>
              <th>Payment Amount</th>
              <th>Payment Status</th>
              <th>Change Status</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($allBookings as $booking): ?>
              <tr>
                <td><?php echo $booking->check_in; ?></td>
                <td><?php echo $booking->check_out; ?></td>
                <td><?php echo $booking->email; ?></td>
                <td><?php echo $booking->phone_number; ?></td>
                <td><?php echo $booking->full_name; ?></td>
                <td><?php echo $booking->room_name; ?></td>
                <td>
                  <?php 
                  $status = strtolower($booking->status);
                  if($status == 'confirmed'){
                      echo '<span class="badge bg-success text-white">Confirmed</span>';
                  } elseif($status == 'pending') {
                      echo '<span class="badge bg-warning text-dark">Pending</span>';
                  } elseif($status == 'done') {
                      echo '<span class="badge bg-secondary text-white">Done</span>';
                  } else {
                      echo '<span class="badge bg-info text-white">'.htmlspecialchars($booking->status).'</span>';
                  }
                  ?>
                </td>
                <td>$<?php echo $booking->payment; ?></td>
                <td>
                  <?php 
                  if($booking->payment > 0){
                      echo '<span class="badge bg-success text-white">Paid</span>';
                  } else {
                      echo '<span class="badge bg-danger text-white">Pending</span>';
                  }
                  ?>
                </td>
                <td>
                  <a href="status-bookings.php?id=<?php echo $booking->id; ?>" class="btn btn-warning text-white">Change</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table> 
      </div>
    </div>
  </div>
</div>

<?php require "../layouts/footer.php"; ?>
