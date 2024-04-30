<?php
include_once 'db_connect.php';

$sql = "SELECT * FROM books";
$result = mysqli_query($conn, $sql);
?>

<!-- Display table of all books -->
<table>
    <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Genre</th>
        <th>Publication Year</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['author']; ?></td>
            <td><?php echo $row['genre']; ?></td>
            <td><?php echo $row['publication']; ?></td>
        </tr>
    <?php } ?>
</table>
