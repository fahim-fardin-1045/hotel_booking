<?php
require "../layouts/header.php";
require "../../config/config.php";

if(!isset($_SESSION['adminname'])) {
    echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php'</script>";
    exit;
}

// Fetch all utilities
$utilities = $conn->query("SELECT * FROM utilities ORDER BY id ASC")->fetchAll(PDO::FETCH_OBJ);
?>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4 d-inline">Room Utilities</h5>
                <a href="create-utilities.php" class="btn btn-primary float-end mb-4">Add Utility</a>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Icon</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($utilities as $util): ?>
                        <tr>
                            <td><?php echo $util->id; ?></td>
                            <td><?php echo htmlspecialchars($util->name); ?></td>
                            <td><?php echo htmlspecialchars($util->icon); ?></td>
                            <td><?php echo htmlspecialchars($util->description); ?></td>
                            <td>
                                <a href="update-utilities.php?id=<?php echo $util->id; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete-utilities.php?id=<?php echo $util->id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
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
