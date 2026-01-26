<?php
require "../layouts/header.php";
require "../../config/config.php";

if(!isset($_SESSION['adminname'])) {
    echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php'</script>";
    exit;
}

// Check if booking ID is provided
$id = $_GET['id'] ?? null;
if(!$id) {
    echo "<script>window.location.href='show-bookings.php'</script>";
    exit;
}

// Handle form submission
if(isset($_POST['submit'])) {
    $status = $_POST['status'];

    if(!empty($status)) {
        $update = $conn->prepare("UPDATE bookings SET status = :status WHERE id = :id");
        $update->execute([
            ':status' => $status,
            ':id' => $id
        ]);

        echo "<script>alert('Booking status updated successfully'); window.location.href='show-bookings.php';</script>";
        exit;
    } else {
        echo "<script>alert('Please select a status');</script>";
    }
}
?>

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-5">Update Booking Status</h5>
        <form method="POST" action="status-bookings.php?id=<?php echo $id; ?>">
          <select name="status" class="form-control mb-3" required>
            <option value="">Choose Status</option>
            <option value="Pending">Pending</option>
            <option value="Confirmed">Confirmed</option>
            <option value="Done">Done</option>
          </select>

          <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require "../layouts/footer.php"; ?>
