<?php
require "../../config/config.php";
session_start(); // Make sure session is started

if(!isset($_SESSION['adminname'])) {
    echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php'</script>";
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if($id > 0) {
    try {
        // Delete from room_utilities first
        $stmt1 = $conn->prepare("DELETE FROM room_utilities WHERE utility_id = :id");
        $stmt1->execute([':id' => $id]);

        // Delete from utilities
        $stmt2 = $conn->prepare("DELETE FROM utilities WHERE id = :id");
        $stmt2->execute([':id' => $id]);

        echo "<script>alert('Utility deleted successfully'); window.location.href='show-utilities.php';</script>";
        exit;
    } catch(PDOException $e) {
        echo "Error deleting utility: " . $e->getMessage();
        exit;
    }
} else {
    echo "<script>alert('Invalid utility ID'); window.location.href='show-utilities.php';</script>";
    exit;
}
