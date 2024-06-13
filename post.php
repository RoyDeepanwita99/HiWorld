<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['post'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $user_id = $_SESSION['user_id'];

    $time = time();

    $query = "INSERT INTO posts (title, content, user_id, time, edited_at) VALUES ('$title', '$content', '$user_id', $time, '0')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: index.php");
        exit();
    } else {
        $error = "Error posting tutorial.";
    }
}
?>

<?php include("header.php"); ?>
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
            box-shadow: 0px 3px 17000px rgba(0, 0, 0, 0.2);
        }

        .bt {
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
            background-color: lightgreen;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<div class="container">
<h2 class="bt">Post a Tutorial</h2>
<form method="POST" action="post.php">
    <label for="title">Title:</label>
    <input type="text" name="title" required>
    <label for="content">Description:</label>
    <textarea name="content" required></textarea>
    <button type="submit" name="post"> <i class="fa fa-edit"></i> Post</button>
</form>
    </div>
<?php if (isset($error)) : ?>
<p class="error"><?php echo $error; ?></p>
<?php endif; ?>

<?php include("footer.php"); ?>