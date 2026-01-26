<?php
require "../layouts/header.php";
require "../../config/config.php";

if(!isset($_SESSION['adminname'])) {
    echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php'</script>";
    exit;
}

$id = $_GET['id'] ?? null;
if(!$id) {
    echo "<script>window.location.href='show-utilities.php'</script>";
    exit;
}

// Fetch utility
$stmt = $conn->prepare("SELECT * FROM utilities WHERE id = :id");
$stmt->execute([':id' => $id]);
$util = $stmt->fetch(PDO::FETCH_OBJ);
if(!$util) {
    echo "<script>alert('Utility not found'); window.location.href='show-utilities.php';</script>";
    exit;
}

if(isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $icon = trim($_POST['icon']);
    $description = trim($_POST['description']);

    if(empty($name) || empty($icon) || empty($description)) {
        echo "<script>alert('All fields are required');</script>";
    } else {
        $update = $conn->prepare("UPDATE utilities SET name=:name, icon=:icon, description=:description WHERE id=:id");
        $update->execute([
            ':name' => $name,
            ':icon' => $icon,
            ':description' => $description,
            ':id' => $id
        ]);

        echo "<script>alert('Utility updated'); window.location.href='show-utilities.php';</script>";
        exit;
    }
}
?>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Update Utility</h5>

                <form method="POST">
                    <input type="text" name="name" class="form-control mb-3" value="<?php echo htmlspecialchars($util->name); ?>" placeholder="Utility Name" required>
                    <input type="text" name="icon" class="form-control mb-3" value="<?php echo htmlspecialchars($util->icon); ?>" placeholder="Icon class" required>
                    <textarea name="description" class="form-control mb-3" placeholder="Description" required><?php echo htmlspecialchars($util->description); ?></textarea>
                    <button type="submit" name="submit" class="btn btn-primary">Update Utility</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require "../layouts/footer.php"; ?>
