<?php
include_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $publication = $_POST['publication'];

    $sql = "INSERT INTO books (title, author, genre, publication) VALUES ('$title', '$author', '$genre', '$publication')";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!-- HTML form for adding a new book -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Title: <input type="text" name="title"><br>
    Author: <input type="text" name="author"><br>
    Genre: <input type="text" name="genre"><br>
    Publication Year: <input type="text" name="publication"><br>
    <input type="submit" value="Add Book">
</form>
