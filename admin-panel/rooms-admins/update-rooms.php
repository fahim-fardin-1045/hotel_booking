<?php
require "../layouts/header.php";
require "../../config/config.php";

// Protect admin route
if(!isset($_SESSION['adminname'])) {
    echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php'</script>";
    exit;
}

// Check room ID
$id = $_GET['id'] ?? null;
if(!$id) {
    echo "<script>window.location.href='show-rooms.php'</script>";
    exit;
}

// Fetch room data
$stmt = $conn->prepare("SELECT * FROM rooms WHERE id = :id");
$stmt->execute([':id' => $id]);
$room = $stmt->fetch(PDO::FETCH_OBJ);
if(!$room) {
    echo "<script>alert('Room not found'); window.location.href='show-rooms.php';</script>";
    exit;
}

// Fetch all hotels
$hotels = $conn->query("SELECT * FROM hotels")->fetchAll(PDO::FETCH_OBJ);

// Fetch all utilities
$allUtilities = $conn->query("SELECT * FROM utilities")->fetchAll(PDO::FETCH_OBJ);

// Fetch room's current utilities
$roomUtilitiesStmt = $conn->prepare("SELECT utility_id FROM room_utilities WHERE room_id = :room_id");
$roomUtilitiesStmt->execute([':room_id' => $id]);
$roomUtilities = $roomUtilitiesStmt->fetchAll(PDO::FETCH_COLUMN);

// Handle form submission
if(isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $num_persons = trim($_POST['num_persons']);
    $num_beds = trim($_POST['num_beds']);
    $size = trim($_POST['size']);
    $view = trim($_POST['view']);
    $hotel_id = $_POST['hotel_id'];

    // Get hotel name from hotel_id
    $hotelStmt = $conn->prepare("SELECT name FROM hotels WHERE id = :id");
    $hotelStmt->execute([':id' => $hotel_id]);
    $hotel = $hotelStmt->fetch(PDO::FETCH_OBJ);
    $hotel_name = $hotel->name ?? '';

    // Handle image update
    $image = $room->image;
    if(isset($_FILES['image']) && $_FILES['image']['name'] != '') {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "room_images/".$image);
    }

    // Update room
    $update = $conn->prepare("UPDATE rooms SET 
        name = :name,
        price = :price,
        num_persons = :num_persons,
        num_beds = :num_beds,
        size = :size,
        view = :view,
        hotel_name = :hotel_name,
        hotel_id = :hotel_id,
        image = :image
        WHERE id = :id
    ");
    $update->execute([
        ':name' => $name,
        ':price' => $price,
        ':num_persons' => $num_persons,
        ':num_beds' => $num_beds,
        ':size' => $size,
        ':view' => $view,
        ':hotel_name' => $hotel_name,
        ':hotel_id' => $hotel_id,
        ':image' => $image,
        ':id' => $id
    ]);

    // Update room utilities
    $conn->prepare("DELETE FROM room_utilities WHERE room_id = :room_id")->execute([':room_id' => $id]);
    if(isset($_POST['utilities']) && is_array($_POST['utilities'])) {
        foreach($_POST['utilities'] as $utility_id) {
            $insertUtility = $conn->prepare("INSERT INTO room_utilities (room_id, utility_id) VALUES (:room_id, :utility_id)");
            $insertUtility->execute([
                ':room_id' => $id,
                ':utility_id' => $utility_id
            ]);
        }
    }

    echo "<script>alert('Room updated successfully'); window.location.href='show-rooms.php';</script>";
    exit;
}
?>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-5">Update Room</h5>

                <form method="POST" action="" enctype="multipart/form-data">

                    <input type="text" name="name" class="form-control mb-3" value="<?php echo htmlspecialchars($room->name); ?>" placeholder="Room Name" required>

                    <input type="file" name="image" class="form-control mb-3">
                    <img src="room_images/<?php echo htmlspecialchars($room->image); ?>" width="100" alt="Room Image" class="mb-3">

                    <input type="text" name="price" class="form-control mb-3" value="<?php echo htmlspecialchars($room->price); ?>" placeholder="Price" required>
                    <input type="text" name="num_persons" class="form-control mb-3" value="<?php echo htmlspecialchars($room->num_persons); ?>" placeholder="Number of Persons" required>
                    <input type="text" name="num_beds" class="form-control mb-3" value="<?php echo htmlspecialchars($room->num_beds); ?>" placeholder="Number of Beds" required>
                    <input type="text" name="size" class="form-control mb-3" value="<?php echo htmlspecialchars($room->size); ?>" placeholder="Size (m²)" required>
                    <input type="text" name="view" class="form-control mb-3" value="<?php echo htmlspecialchars($room->view); ?>" placeholder="Room View" required>

                    <!-- Hotel dropdown -->
                    <select name="hotel_id" class="form-control mb-3" required>
                        <option value="">Select Hotel</option>
                        <?php foreach($hotels as $hotel): ?>
                            <option value="<?php echo $hotel->id; ?>" <?php if($room->hotel_id == $hotel->id) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($hotel->name); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <!-- Utilities checkboxes -->
                    <label>Room Utilities</label>
                    <div class="mb-3">
                        <?php foreach($allUtilities as $utility): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="utilities[]" value="<?php echo $utility->id; ?>" id="utility<?php echo $utility->id; ?>" <?php if(in_array($utility->id, $roomUtilities)) echo 'checked'; ?>>
                                <label class="form-check-label" for="utility<?php echo $utility->id; ?>">
                                    <?php echo htmlspecialchars($utility->name); ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary mt-3">Update Room</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require "../layouts/footer.php"; ?>
