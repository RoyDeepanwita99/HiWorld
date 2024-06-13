<?php
session_start();
include("db.php");

if (isset($_GET["post_id"])) {
    $post_id = $_GET["post_id"];

    // Retrieve the post from the database
    $query = "SELECT * FROM posts WHERE post_id = '$post_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $post = mysqli_fetch_assoc($result);

        // Retrieve comments for the post
        $comment_query = "SELECT * FROM comments WHERE post_id = '$post_id' ORDER BY created_at DESC";
        $comment_result = mysqli_query($conn, $comment_query);
        $comments = [];

        while ($comment = mysqli_fetch_assoc($comment_result)) {
            $comments[] = $comment;
        }
    } else {
        $error = "Post not found.";
    }
}
?>

<?php include("header.php"); ?>

<div class="post">
    <h2><?php echo $post['title']; ?></h2>
    <p><?php echo $post['content']; ?></p>
</div>

<h3>Comments</h3>

<?php foreach ($comments as $comment) : ?>
    <div class="comment">
        <p><?php echo $comment['content']; ?></p>
        <p>Commented at <?php echo $comment['created_at']; ?></p>
    </div>
<?php endforeach; ?>

<?php if (isset($_SESSION['user_id'])) : ?>
    <h3>Add a Comment</h3>
    <form method="POST" action="add_comment.php">
        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
        <textarea name="content" required></textarea>
        <button type="submit">Submit Comment</button>
    </form>
<?php else : ?>
    <p>You must be logged in to leave a comment. <a href="login.php">Login</a></p>
<?php endif; ?>

<?php if (isset($error)) : ?>
    <p class="error"><?php echo $error; ?></p>
<?php endif; ?>

<?php include("footer.php"); ?>
