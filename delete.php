<?php

session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

if (isset($_GET["post_id"])) {
    $post_id = $_GET["post_id"];
    $user_id = $_SESSION['user_id'];

    // Delete the post from the database
    $query = "DELETE FROM posts WHERE post_id='$post_id' AND user_id='$user_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: index.php");
    }
}
?>