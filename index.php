<?php
session_start();
include("db.php");

$query = "SELECT posts.*, users.username FROM posts INNER JOIN users ON posts.user_id = users.user_id";
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
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .w {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .anc1 {
            color: black;
            text-decoration: none;
            margin-left: 10px;
        }

        .post {
            border: 1px solid #ccc;
            border-radius: 10px;
            margin-bottom: 20px;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .post h3 a {
            text-decoration: none;
            color: blue;
        }

        .post p {
            color: #333;
            text-align: justify;
        }

        .comment_section {
            background-color: #eeeeee;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        .show-comments {
            text-decoration: none;
            color: blue;
            font-weight: bold;
        }

        .anc1.edit,
        .anc1.delete {
            text-decoration: none;
            font-weight: bold;
            margin-left: 10px;
        }

        .anc1.delete {
            color: red;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 3px 17000px rgba(0, 0, 0, 0.2);
        }
           /* Edit button style */
        .edit-button {
            background-color: #333; /* Dark gray */
            color: #fff; /* White text */
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            margin-right: 10px;
            text-decoration: none;
            transition: background-color 0.3s; /* Smooth transition */
            display: inline-block;
        }

        .edit-button:hover {
            background-color: #222; /* Darker gray on hover */
        }

        /* Delete button style */
        .delete-button {
            background-color: #ff5555; /* Attractive red */
            color: #fff; /* White text */
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            text-decoration: none;
            transition: background-color 0.3s; /* Smooth transition */
            display: inline-block;
        }

        .delete-button:hover {
            background-color: #ff3333; /* Slightly lighter red on hover */
        }
        .leavecomment {
    display: inline-block;
    padding: 10px 20px;
    background: linear-gradient(to bottom, #f7f7f7, #e0e0e0); /* Gradient background */
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); /* Shadow effect */
    text-decoration: none;
    color: #333;
    font-weight: bold;
    transition: background 0.3s, box-shadow 0.3s;
}

.leavecomment:hover {
    background: linear-gradient(to bottom, #e0e0e0, #f7f7f7); /* Gradient background on hover */
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3); /* Enhanced shadow effect on hover */
}
.show-comments-link {
    display: inline-block;
    padding: 10px 20px;
    background: rgba(255, 255, 255, 0.7); /* Light-colored transparent background */
    color: #333; /* Text color */
    font-weight: bold;
    text-decoration: none;
    border: 1px solid #ccc;
    border-radius: 5px;
    transition: background 0.3s;
}

.show-comments-link:hover {
    background: rgba(255, 255, 255, 1); /* Increase opacity on hover */
}


    </style>
</head>
<!-- <h2>Welcome to BU Tutorial Point</h2> -->
  <?php if (isset($_SESSION['user_id'])) : ?>
<p class="w">  <i class="fa fa-star"></i> Welcome, <?php echo $_SESSION['username']; ?>! <a href="logout.php" class="anc1"></a></p>
<?php endif; ?>

<?php foreach ($posts as $post) : ?>
    <div class="container">
<div class="post">
    <h3>
        <a href="article.php?id=<?php echo $post['post_id']; ?>"
            style="text-decoration: none; color:black;"> <?php echo $post['title']; ?></a>
    </h3>
    <p style="color:black">Posted by <?php echo $post['username']; ?></p>
    <p style="color:black">at  <?php echo date("d-m-Y h:i:sa", $post['time']); ?></p>
    <p style="color:black; text-align:justify"><?php echo $post['content']; ?></p>
   


    <div class="comment_section"
        style="width: 100%; background-color: #eeeeee; box-sizing: border-box; padding: 10px; border-radius: 4px; margin-bottom: 15px;">
        <?php echo get_comment($post['post_id']); ?>
        
                <a href="article.php?id=<?php echo $post['post_id']; ?>"
            style="text-decoration: none; color:green; font-weight:bold;"  class="show-comments-link"> <i class="fa fa-comments"></i> Show all Comments</a>
           
    </div>


   <!-- <p style="color:black"><a href="article.php?id=<?php echo $post['post_id']; ?>"
            style="text-decoration: none; color:green; font-weight:bold;">Show all Comments</a></p> -->

    <a href='edit_post.php?post_id=<?php echo $post['post_id']; ?>' class="edit-button"><i class="fa fa-pencil"></i> Edit</a>
    <a href='delete.php?post_id=<?php echo $post['post_id']; ?>' class="delete-button"><i class="fa fa-trash"></i> Delete</a>

    <?php if (isset($_SESSION['user_id'])) : ?>
    <?php endif; ?>
</div>
    </div>
<?php endforeach; ?>

<?php include("footer.php"); ?>