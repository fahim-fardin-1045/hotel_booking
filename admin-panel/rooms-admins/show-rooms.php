<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>

<?php 
// Check admin login
if(!isset($_SESSION['adminname'])) {
    echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php'</script>";
    exit;
}

// Fetch all rooms
$rooms = $conn->query("SELECT * FROM rooms");
$rooms->execute();
$allRooms = $rooms->fetchAll(PDO::FETCH_OBJ);
?>  

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4 d-inline">Rooms</h5>
                <a href="create-rooms.php" class="btn btn-primary mb-4 text-center float-right">Create Room</a>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Num of Persons</th>
                            <th>Size</th>
                            <th>View</th>
                            <th>Num of Beds</th>
                            <th>Hotel Name</th>
                            <th>Status</th>
                            <th>Change Status</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($allRooms as $room): ?>
                        <tr>
                            <th scope="row"><?php echo $room->id; ?></th>
                            <td><?php echo $room->name; ?></td>
                            <td>$<?php echo $room->price; ?></td>
                            <td><?php echo $room->num_persons; ?></td>
                            <td><?php echo $room->size; ?></td>
                            <td><?php echo $room->view; ?></td>
                            <td><?php echo $room->num_beds; ?></td>
                            <td><?php echo $room->hotel_name; ?></td>
                            <td><?php echo $room->status ? 'Active' : 'Inactive'; ?></td>

                            <td>
                                <a href="status-rooms.php?id=<?php echo $room->id; ?>" class="btn btn-warning text-white">Status</a>
                            </td>

                            <td>
                                <a href="update-rooms.php?id=<?php echo $room->id; ?>" class="btn btn-info text-white">Update</a>
                            </td>

                            <td>
                                <a href="delete-rooms.php?id=<?php echo $room->id; ?>" class="btn btn-danger">Delete</a>
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
