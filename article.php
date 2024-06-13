<?php
session_start();
include("db.php");
$sql = "SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.user_id WHERE post_id = {$_GET['id']}";
$res = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($res);


$sql = "SELECT comments.content, users.username FROM comments JOIN users ON comments.user_id = users.user_id WHERE post_id = {$_GET['id']}";
$res = mysqli_query($conn, $sql);


$comment = [];
while($row = mysqli_fetch_assoc($res)){
    array_push($comment, $row);
}


$comment_string = "";

foreach($comment as $item){

    $comment_string .= "<div class='comment_template'>
                            <p class='comment_author'>
                                {$item['username']}
                            </p>
                            <p class='comment_body'>
                                {$item['content']}
                            </p>
                        </div>";


}





?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Post Page</title>
    <!-- Link to Bootstrap CSS -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <style>
    .comment h2 {
        margin-top: 20px;
        margin-bottom: 20px;
    }
   

.comment_author {
    font-weight: bold;
}



    .comment_content {
        margin: 0;
        font-size: 1.1rem;
    }

    .comment_template p:nth-child(1) {
        font-weight: bold;
        margin-bottom: 5px;

    }
    .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 2000px rgba(0, 0, 0, 0.1);
        }
        .leavecomment{
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
        .comment {
        border: 1px solid #ddd;
        padding: 20px;
        margin-bottom: 20px;
        background-color: #f9f9f9;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    </style>
</head>

<body>

    <?php
    include('header.php');?>


    <!--<h2>Welcome to BU Tutorial Point</h2> -->

    <?php if (isset($_SESSION['user_id'])) : ?>
    <p class="w">Welcome, <?php echo $_SESSION['username']; ?>! <a href="logout.php" class="anc1"></a></p>
    <?php endif; ?>

<div class="container">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1 class="text-center"><?php echo $data['title']; ?></h1>
                <p class="text-center">
                    Posted on
                    <span class="">
                        <?php echo date("d-m-Y h:i:sa", $data['time']); ?>
                    </span>
                    <br>
                    <?php 
                    
                        if($data['edited_at'] != 0){
                            $m_date = date("d-m-Y h:i:sa", $data['edited_at']);
                            echo "Modified on 
                            <span class=''>
                                $m_date
                            </span>";
                        }
                    
                    ?>
                    by
                    <span class="font-weight-bold">
                        <?php echo $data['username']; ?>
                    </span>
                </p>
                <p class="text-justify"><?php echo $data['content']; ?></p>



                <div class="comment">
                    <h2>Comments here</h2>
                    <?php echo $comment_string; ?>
                    <a class="leavecomment" href="add_comment.php?id=<?php echo $data['post_id']; ?>">
                    <i class="fa fa-comment"></i>   Leave a comment
                </a>

                </div>

                



            </div>
        </div>
    </div>
                    </div>
    <!-- Link to Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<?php  include('footer.php');?>