<?php
session_start();
require "../includes/header.php";
require "../config/config.php";

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Get booking ID from GET
$booking_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (!$booking_id) {
    echo "<script>alert('Booking not found.'); window.location.href='" . APPURL . "';</script>";
    exit;
}

// Fetch booking with room & hotel details
$bookingStmt = $conn->prepare("
    SELECT b.*, r.name AS room_name, r.price AS room_price, h.name AS hotel_name
    FROM bookings b
    INNER JOIN rooms r ON b.room_id = r.id
    INNER JOIN hotels h ON r.hotel_id = h.id
    WHERE b.id = :booking_id
");
$bookingStmt->execute([':booking_id' => $booking_id]);
$booking = $bookingStmt->fetch(PDO::FETCH_OBJ);

if (!$booking) {
    echo "<script>alert('Booking not found.'); window.location.href='" . APPURL . "';</script>";
    exit;
}

// Handle demo payment
if (isset($_POST['pay_now'])) {
    $updateStmt = $conn->prepare("UPDATE bookings SET status = 'Confirmed' WHERE id = :id");
    $updateStmt->execute([':id' => $booking->id]);

    echo "<script>alert('Payment successful! Your booking is confirmed.'); window.location.href='" . APPURL . "';</script>";
    exit;
}
?>

<style>
.pay-demo-hero {
    background: url('<?php echo APPURL; ?>/images/image_2.jpg') center center / cover no-repeat;
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 50px 15px;
}
.pay-demo-hero::before {
    content: "";
    position: absolute;
    top:0; left:0; right:0; bottom:0;
    background: rgba(0,0,0,0.6);
    z-index: 1;
}
.pay-demo-container {
    position: relative;
    z-index: 2;
    max-width: 700px;
    width: 100%;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    padding: 30px 40px;
}
.booking-info {
    border: 1px solid #eee;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 25px;
    background-color: #f9f9f9;
}
.booking-info h4 { margin-bottom: 15px; font-weight: 600; }
.payment-methods label {
    display: block;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin-bottom: 12px;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
    background-color: #f8f8f8;
}
.payment-methods input[type="radio"]:checked + label {
    border-color: #007bff;
    background-color: #e6f0ff;
    font-weight: 600;
}
.btn-pay { width: 100%; font-size: 18px; padding: 12px; border-radius: 8px; }
.text-muted { font-size: 14px; color: #666; }
@media(max-width:768px){ .pay-demo-container { padding: 20px; } }
</style>

<div class="pay-demo-hero">
    <div class="pay-demo-container text-center">
        <h2 class="mb-4">Demo Payment Page</h2>
        <p class="mb-4 text-secondary">Complete your booking payment below. This is a demo page – no real payment will be processed.</p>

        <div class="booking-info text-left">
            <h4>Booking Details</h4>
            <p><strong>Room:</strong> <?php echo htmlspecialchars($booking->room_name); ?></p>
            <p><strong>Hotel:</strong> <?php echo htmlspecialchars($booking->hotel_name); ?></p>
            <p><strong>Check-In:</strong> <?php echo htmlspecialchars($booking->check_in); ?></p>
            <p><strong>Check-Out:</strong> <?php echo htmlspecialchars($booking->check_out); ?></p>
            <p><strong>Total Payment:</strong> $<?php echo number_format($booking->payment,2); ?></p>
        </div>

        <form method="POST">
            <div class="payment-methods mb-3 text-left">
                <h4>Select Payment Method</h4>
                <input type="radio" id="bkash" name="method" value="bkash" checked hidden>
                <label for="bkash">Bkash</label>
                <input type="radio" id="rocket" name="method" value="rocket" hidden>
                <label for="rocket">Rocket</label>
                <input type="radio" id="paypal" name="method" value="paypal" hidden>
                <label for="paypal">PayPal</label>
            </div>
            <button type="submit" name="pay_now" class="btn btn-primary btn-pay">Pay Now</button>
        </form>

        <p class="mt-3 text-muted">This is a demo page. Your booking will be marked as confirmed when you click Pay Now.</p>
    </div>
</div>

<?php require "../includes/footer.php"; ?>
