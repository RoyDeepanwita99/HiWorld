

<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $post_id = $_GET["id"];
    $content = mysqli_real_escape_string($conn, $_POST["comment"]);
    $user_id = $_SESSION['user_id'];

    // Insert the comment into the database
    $query = "INSERT INTO comments (content, post_id, user_id) VALUES ('$content', '$post_id', '$user_id')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: article.php?id=$post_id");
    }
}
?>



<?php include('header.php');?>
<!DOCTYPE html>
<html lang="en">

<head>  <style>
        .submit{
            display: block;
            width: 100%;
            padding: 10px;
            background-color: green;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 1700px rgba(0, 0, 0, 0.1);
        }
  
        </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave a Comment</title>
    <!-- Link to Bootstrap CSS -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
</head>

<body>



    <!-- <h2 style="margin-top:-15px; ">Welcome to BU Tutorial Point</h2> -->

    <?php if (isset($_SESSION['user_id'])) : ?>
<p class="w" style="margin-bottom: 10px;">Welcome, <?php echo $_SESSION['username']; ?>! <a href="logout.php" class="anc1"></a></p>
<?php endif; ?>
<div class="container">
    <div class="">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1 class="text-center">Leave a Comment</h1>
                <form class action="<?php echo $_SERVER["PHP_SELF"] . "?id=" . $_GET['id'] ; ?>" method="POST">
                    <div class="form-group">
                        <label for="username">Your Name:</label>
                        <input type="text" disabled class="form-control" id="username" name="username"
                            value="<?php echo $_SESSION['username']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="comment">Your Comment:</label>
                        <textarea class="form-control" id="comment" name="comment" rows="4" required></textarea>
                    </div>
                    <input type="hidden" name="post_id" value="5"> <!-- Replace with the actual post_id -->
                    <button type="submit" class="submit">Submit Comment</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- Link to Bootstrap JS and jQuery (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php include("footer.php"); ?>