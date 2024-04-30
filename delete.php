<?php
include_once 'db_connect.php';

$id = $_GET['id'];
$sql = "DELETE FROM books WHERE id=$id";
if (mysqli_query($conn, $sql)) {
    header("Location: index.php");
    exit;
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
?>
