<?php
session_start();
include("db.php");

$query = "SELECT posts.*, users.username FROM posts INNER JOIN users ON posts.user_id = users.user_id AND posts.user_id = {$_SESSION['user_id']}";
$result = mysqli_query($conn, $query);
$posts = [];

while ($row = mysqli_fetch_assoc($result)) {
    $posts[] = $row;
    } 


function get_comment($id){
    global $conn;
    $sql = "SELECT comments.content, users.username FROM `comments` JOIN users ON comments.user_id = users.user_id WHERE post_id=$id LIMIT 2";
    $response = mysqli_query($conn, $sql);

    $comment = "";

    while($row = mysqli_fetch_assoc($response)){
        $comment .= "<div style='margin-bottom: 15px;'>
                        <p style='font-weight: bold;'>{$row['username']}</p>
                        <p>{$row['content']}</p>
                    </div>";

    }

    return $comment;
}


?>



<?php include("header.php"); ?>


<?php if (!isset($_SESSION['user_id'])){
    header("Location: index.php");
}

?>


<head>
    <style>

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 3px 1700px rgba(3, 3, 3, 0.2);
        }
        .content {
        color: black;
        box-sizing: border-box;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }
    .post {
            border: 1px solid #ccc;
            border-radius: 10px;
            margin-bottom: 20px;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<div class="container">
<?php if (isset($_SESSION['user_id'])) : ?>
<h2>Posts by <?php echo $_SESSION['username']; ?></h2>
<?php endif; ?>

<?php foreach ($posts as $post) : ?>
<div class="post">
    <h3>
        <a href="article.php?id=<?php echo $post['post_id']; ?>"
            style="text-decoration: none; color:black;"><?php echo $post['title']; ?></a>
    </h3>

<!--
    <style>
    .content {
        color: black;
        box-sizing: border-box;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }
    </style>

-->

    <p class="content"><?php echo $post['content']; ?></p>

    <?php if (isset($_SESSION['user_id'])) : ?>
    <?php endif; ?>
</div>

<?php endforeach; ?>
    </div>   
<?php include("footer.php"); ?>