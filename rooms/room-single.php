<?php
require "../includes/header.php";
require "../config/config.php";

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check room ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (!$id) {
    echo "<script>window.location.href='" . APPURL . "/404.php';</script>";
    exit;
}

// Fetch room + hotel info
$roomStmt = $conn->prepare("
    SELECT r.*, h.name AS hotel_name 
    FROM rooms r
    LEFT JOIN hotels h ON r.hotel_id = h.id
    WHERE r.status = 1 AND r.id = :id
");
$roomStmt->execute([':id' => $id]);
$room = $roomStmt->fetch(PDO::FETCH_OBJ);
if (!$room) { echo "<p>Room not found!</p>"; exit; }

// Fetch room utilities
$utilStmt = $conn->prepare("
    SELECT u.*
    FROM utilities u
    INNER JOIN room_utilities ru ON u.id = ru.utility_id
    WHERE ru.room_id = :room_id
");
$utilStmt->execute([':room_id' => $id]);
$utilities = $utilStmt->fetchAll(PDO::FETCH_OBJ);

// Handle booking submission
if (isset($_POST['submit'])) {
    if (!isset($_SESSION['username'])) {
        echo "<script>alert('Please login to book this room'); window.location.href='" . APPURL . "/users/login.php';</script>";
        exit;
    }

    $user_id = $_SESSION['id'];
    $email = trim($_POST['email']);
    $full_name = trim($_POST['full_name']);
    $phone_number = trim($_POST['phone_number']);
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $payment = $room->price;

    if (!$email || !$full_name || !$phone_number || !$check_in || !$check_out) {
        echo "<script>alert('All fields are required');</script>";
    } else {
        // Insert booking into database with room_name & hotel_name
        $insertBooking = $conn->prepare("
            INSERT INTO bookings 
            (user_id, room_id, room_name, hotel_name, email, full_name, phone_number, check_in, check_out, payment, status)
            VALUES 
            (:user_id, :room_id, :room_name, :hotel_name, :email, :full_name, :phone_number, :check_in, :check_out, :payment, 'Pending')
        ");

        $insertBooking->execute([
            ':user_id' => $user_id,
            ':room_id' => $room->id,
            ':room_name' => $room->name,
            ':hotel_name' => $room->hotel_name,
            ':email' => $email,
            ':full_name' => $full_name,
            ':phone_number' => $phone_number,
            ':check_in' => $check_in,
            ':check_out' => $check_out,
            ':payment' => $payment
        ]);

        $booking_id = $conn->lastInsertId();

        // Redirect to pay.php with booking ID
        echo "<script>window.location.href='" . APPURL . "/rooms/pay.php?id=" . $booking_id . "';</script>";
        exit;
    }
}
?>



<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

<style>
body, h1, h2, h3, p, li { font-family: 'Roboto', sans-serif; }
.hero-wrap h1 { font-size: 3rem; font-weight: 700; text-shadow: 2px 2px 6px rgba(0,0,0,0.5); }
.hero-wrap p { font-size: 1.5rem; font-weight: 500; text-shadow: 1px 1px 4px rgba(0,0,0,0.5); }
.card { font-size: 1.1rem; }
.badge { font-size: 0.95rem; padding: 0.55em 0.8em; }
.btn-primary { font-weight: 600; }
</style>

<!-- HERO -->
<section class="hero-wrap" style="background-image: url('<?php echo ROOMSIMAGES . '/' . htmlspecialchars($room->image); ?>'); height: 400px; background-size: cover; background-position: center; position: relative;">
    <div class="overlay" style="background: rgba(0,0,0,0.3); height: 100%; width: 100%; position: absolute; top: 0; left: 0;"></div>
    <div class="container h-100 d-flex flex-column align-items-center justify-content-center position-relative text-white text-center">
        <h1 class="mb-2"><?php echo htmlspecialchars($room->name); ?></h1>
        <p class="mb-1">Hotel: <?php echo htmlspecialchars($room->hotel_name); ?></p>
        <p class="mb-0">$<?php echo number_format($room->price,2); ?> / night</p>
    </div>
</section>

<!-- ROOM INFO & BOOKING -->
<section class="ftco-section bg-light py-5">
    <div class="container">
        <div class="row">

            <!-- Room Details -->
            <div class="col-lg-7 mb-4">
                <div class="card shadow-sm">
                    <img src="<?php echo ROOMSIMAGES . '/' . htmlspecialchars($room->image); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($room->name); ?>">
                    <div class="card-body">
                        <h3 class="card-title"><?php echo htmlspecialchars($room->name); ?></h3>
                        <p class="card-text"><strong>Hotel:</strong> <?php echo htmlspecialchars($room->hotel_name); ?></p>
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item"><strong>Max Persons:</strong> <?php echo htmlspecialchars($room->num_persons); ?></li>
                            <li class="list-group-item"><strong>Room Size:</strong> <?php echo htmlspecialchars($room->size); ?> m²</li>
                            <li class="list-group-item"><strong>View:</strong> <?php echo htmlspecialchars($room->view); ?></li>
                            <li class="list-group-item"><strong>Beds:</strong> <?php echo htmlspecialchars($room->num_beds); ?></li>
                        </ul>

                        <!-- Utilities -->
                        <?php if($utilities): ?>
                            <h5 class="mb-2">Utilities & Amenities</h5>
                            <div class="mb-3">
                                <?php foreach($utilities as $util): ?>
                                    <span class="badge badge-primary mr-1 mb-1">
                                        <?php if($util->icon) echo '<i class="' . htmlspecialchars($util->icon) . '"></i> '; ?>
                                        <?php echo htmlspecialchars($util->name); ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Booking Form -->
            <div class="col-lg-5">
                <div class="card shadow-sm p-3">
                    <h4 class="mb-3">Book This Room</h4>
                    <form method="POST" class="needs-validation" novalidate>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="full_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="phone_number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Check-in</label>
                            <input type="date" name="check_in" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Check-out</label>
                            <input type="date" name="check_out" class="form-control" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary btn-block">Book & Pay</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php require "../includes/footer.php"; ?>
