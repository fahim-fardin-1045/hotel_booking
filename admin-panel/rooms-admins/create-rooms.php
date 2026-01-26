<?php
require "../layouts/header.php";
require "../../config/config.php";

// Protect admin route
if(!isset($_SESSION['adminname'])) {
    echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php'</script>";
    exit;
}

// Fetch all hotels
$hotels = $conn->query("SELECT * FROM hotels")->fetchAll(PDO::FETCH_OBJ);

// Fetch all utilities
$allUtilities = $conn->query("SELECT * FROM utilities")->fetchAll(PDO::FETCH_OBJ);

// Handle form submission
if(isset($_POST['submit'])) {

    // Collect room data
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $num_persons = trim($_POST['num_persons']);
    $num_beds = trim($_POST['num_beds']);
    $size = trim($_POST['size']);
    $view = trim($_POST['view']);
    $hotel_name = $_POST['hotel_name'];

    // Get hotel ID from selected hotel name
    $stmtHotel = $conn->prepare("SELECT id FROM hotels WHERE name = :name");
    $stmtHotel->execute([':name' => $hotel_name]);
    $hotel = $stmtHotel->fetch(PDO::FETCH_ASSOC);
    $hotel_id = $hotel['id'] ?? null;

    // Validate inputs
    if(empty($name) || empty($price) || empty($num_persons) || empty($num_beds) || empty($size) || empty($view) || !$hotel_id) {
        echo "<script>alert('One or more inputs are empty');</script>";
    } else {

        // Handle image upload
        $image = $_FILES['image']['name'] ?? '';
        if($image != '') {
            $targetDir = "room_images/";
            $targetFile = $targetDir . basename($image);
            move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
        }

        // Insert room
        $insertRoom = $conn->prepare("INSERT INTO rooms (name, price, num_persons, num_beds, size, view, hotel_name, hotel_id, image) 
                                      VALUES (:name, :price, :num_persons, :num_beds, :size, :view, :hotel_name, :hotel_id, :image)");
        $insertRoom->execute([
            ':name' => $name,
            ':price' => $price,
            ':num_persons' => $num_persons,
            ':num_beds' => $num_beds,
            ':size' => $size,
            ':view' => $view,
            ':hotel_name' => $hotel_name,
            ':hotel_id' => $hotel_id,
            ':image' => $image
        ]);

        $room_id = $conn->lastInsertId();

        // Insert room utilities
        if(isset($_POST['utilities']) && is_array($_POST['utilities'])) {
            foreach($_POST['utilities'] as $utility_id) {
                $insertUtility = $conn->prepare("INSERT INTO room_utilities (room_id, utility_id) VALUES (:room_id, :utility_id)");
                $insertUtility->execute([
                    ':room_id' => $room_id,
                    ':utility_id' => $utility_id
                ]);
            }
        }

        echo "<script>alert('Room created successfully'); window.location.href='show-rooms.php';</script>";
        exit;
    }
}
?>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Create Room</h5>

                <form method="POST" action="" enctype="multipart/form-data">

                    <input type="text" name="name" class="form-control mb-3" placeholder="Room Name" required>

                    <input type="file" name="image" class="form-control mb-3">

                    <input type="text" name="price" class="form-control mb-3" placeholder="Price" required>
                    <input type="text" name="num_persons" class="form-control mb-3" placeholder="Number of Persons" required>
                    <input type="text" name="num_beds" class="form-control mb-3" placeholder="Number of Beds" required>
                    <input type="text" name="size" class="form-control mb-3" placeholder="Size (m²)" required>
                    <input type="text" name="view" class="form-control mb-3" placeholder="Room View" required>

                    <select name="hotel_name" class="form-control mb-3" required>
                        <option value="">Select Hotel</option>
                        <?php foreach($hotels as $hotel): ?>
                            <option value="<?php echo $hotel->name; ?>"><?php echo htmlspecialchars($hotel->name); ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label>Room Utilities</label>
                    <div class="mb-3">
                        <?php foreach($allUtilities as $utility): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="utilities[]" value="<?php echo $utility->id; ?>" id="utility<?php echo $utility->id; ?>">
                                <label class="form-check-label" for="utility<?php echo $utility->id; ?>">
                                    <?php echo htmlspecialchars($utility->name); ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary mt-3">Create Room</button>
                </form>

            </div>
        </div>
    </div>
</div>

<?php require "../layouts/footer.php"; ?>
