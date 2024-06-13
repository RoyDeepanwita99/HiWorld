<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $post_id = $_POST["post_id"];
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $content = mysqli_real_escape_string($conn, $_POST["content"]);
    $user_id = $_SESSION['user_id'];

    $edited_at = time();

    // Update the post in the database
    $query = "UPDATE posts SET title='$title', edited_at=$edited_at, content='$content' WHERE post_id='$post_id' AND user_id='$user_id'";
      
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: index.php?");
        exit();
    } else {
        $error = "Error updating post.";
    }
} else {
    $post_id = $_GET["post_id"];

    // Retrieve the post from the database
    $query = "SELECT * FROM posts WHERE post_id='$post_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $post = mysqli_fetch_assoc($result);
    } else {
        $error = "Post not found.";
    }
}
?>
<head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form label {
            font-weight: bold;
        }

        form input[type="text"],
        form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        form button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: green;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #222;
        }
    </style>

</head>
<?php include("header.php"); ?>

<?php

if($_SESSION['user_id'] != $post['user_id']){
    echo "You are not the author!";
}else{


?>





<div class="container ">
<h2>Edit Post</h2>
<form method="POST" action="edit_post.php">
    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
    <label for="title">Title:</label>
    <input type="text" name="title" value="<?php echo $post['title']; ?>" required>
    <label for="content">Content:</label>
    <textarea name="content" required><?php echo $post['content']; ?></textarea>
    <button type="submit"><i class="fa fa-floppy-o"></i>  Save Changes</button>
</form>
</div>
<?php


}


?>

<?php if (isset($error)) : ?>
<p class="error"><?php echo $error; ?></p>
<?php endif; ?>

<?php include("footer.php"); ?>