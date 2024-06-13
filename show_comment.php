
<?php
// Include your database connection here
include("db.php");

// Fetch posts from the database
$query = "SELECT * FROM posts";
$result = mysqli_query($conn, $query);


// Check if there are any posts
if (mysqli_num_rows($result) > 0) {
    // Loop through each post
    while ($post = mysqli_fetch_assoc($result)) {
        echo "<div class='post'>";
        echo "<p>{$post['content']}</p>";
        
        // Retrieve comments for this post
        $post_id = $post['post_id'];
        $comment_query = "SELECT * FROM comments WHERE post_id = $post_id";
        $comment_result = mysqli_query($conn, $comment_query);

        if (mysqli_num_rows($comment_result) > 0) {
            echo "<div class='comments'>";
            
            // Loop through the comments for this post
            while ($comment = mysqli_fetch_assoc($comment_result)) {
                echo "<div class='comment'>";
                echo "<p>{$comment['content']}</p>";
                echo "</div>";
            }

            echo "</div>"; // Close comments div
        }
        
        echo "</div>"; // Close post div
    }
} else {
    echo "No posts found.";
}


?>
