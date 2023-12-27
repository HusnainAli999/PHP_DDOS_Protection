<!-- in this code user can submit the comment again with some changing but not insert the same comment again for 100 seconds -->
<?php
session_start();
include "config.php";
include "css.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    // Check if the user has submitted the same comment twice in the last 10 seconds
    $checkComment = mysqli_prepare($conn, "SELECT COUNT(*) as count FROM comment_table WHERE comment = ? AND user_id = ? AND timestamp > NOW() - INTERVAL 100 SECOND");
    $checkComment->bind_param("si", $comment, $_SESSION['logins']);
    $checkComment->execute();
    $result = $checkComment->get_result();

    if ($row = mysqli_fetch_assoc($result)) {
        $commentCount = $row['count'];

        if ($commentCount >= 2) {
            echo "<script> alert('You cannot submit the same comment more than twice within 100 seconds. Try again later.'); </script>";
            exit;
        }
    }

    // Insert the new comment or update the timestamp if the same comment exists
    $upsertComment = mysqli_prepare($conn, "
        INSERT INTO comment_table (name, comment, user_id, timestamp)
        VALUES (?, ?, ?, NOW())
        ON DUPLICATE KEY UPDATE timestamp = NOW()
    ");
    $upsertComment->bind_param("ssi", $_SESSION['logins_name'], $comment, $_SESSION['logins']);

    if ($upsertComment->execute()) {
        echo "<h1 class='alert_h1'> Comment Successfully DONE. </h1>";
    } else {
        // Check if the error is due to a duplicate entry
        if (mysqli_errno($conn) == 1062) { // 1062 is the MySQL error code for duplicate entry
            echo "<script> alert('You cannot submit the same comment again so soon.'); </script>";
        } else {
            echo "<h1 class='alert_h1'> Comment Failed To Process in index2.php </h1>";
        }
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <?php include "navBar.php";  ?>
    <h2 class="index_h2">Husnain's DDOS Defender: Keeping your online world safe and sound from cyber storms.</h2>

    <form action="" method="POST" id="comment_form">
        <div>
            <label>Comment</label><br>
            <textarea name="comment" required></textarea>
        </div>

        <div>
            <input type="submit" value="Submit" name='submit'>
        </div>
    </form>

    <?php
    $stmt = mysqli_prepare($conn, "SELECT * FROM comment_table");
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo "<div class='comment_inner_handler_div'>";
        echo "<p class='commenter_name'> Name : " . htmlspecialchars($row['name']) . "</p>";
        echo "<p class='user_comment'> Comment : " . htmlspecialchars($row['comment']) . "</p>";
        echo "</div>";
    }
    ?>
</body>

</html>