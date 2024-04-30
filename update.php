<?php
include_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $publication = $_POST['publication'];

    $sql = "UPDATE books SET title='$title', author='$author', genre='$genre', publication='$publication' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!-- HTML form for updating a book -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    Title: <input type="text" name="title" value="<?php echo $_GET['title']; ?>"><br>
    Author: <input type="text" name="author" value="<?php echo $_GET['author']; ?>"><br>
    Genre: <input type="text" name="genre" value="<?php echo $_GET['genre']; ?>"><br>
    Publication Year: <input type="text" name="publication" value="<?php echo $_GET['publication']; ?>"><br>
    <input type="submit" value="Update Book">
</form>
