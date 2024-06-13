<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($username==$row['username'] && $password== $row["password"]) {
                $_SESSION["user_id"] = $row["user_id"];
                $_SESSION["username"] = $row["username"];
                header("Location: index.php");
                exit();
            } else {
                $error = "Incorrect password. Please try again.";
            }
        } else {
            $error = "User not found. Please check your username.";
        }
    } else {
        $error = "Database error. Please try again later.";
    }
}
?>

<?php include("header.php"); ?>




<head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .login {
            background: #fff;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .bt {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin: 10px 0;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button {
            background: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background: #555;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<h2 class="bt">Sign in</h2>
<form method="POST" action="login.php" class="login">
    <label for="username"> <i class="fa fa-user"></i> Username:</label>
    <input type="text" name="username" required>
    <label for="password"><i class="fa fa-key"></i> Password:</label>
    <input type="password" name="password" required>
    <button type="submit">Login</button>
</form>

<?php if (isset($error)) : ?>
    <p class="error"><?php echo $error; ?></p>
<?php endif; ?>

<?php include("footer.php"); ?>
