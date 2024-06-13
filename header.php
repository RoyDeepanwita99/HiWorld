<!-- header.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Tutorial Site</title>
   <!-- <link rel="stylesheet" type="text/css" href="style.css"> 3-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


   <style>
        /* Reset default styles */
        body, ul, li {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        /* Style the header */
        header {
            background: #333; /* Dark background color */
            color: #fff; /* White text color */
            padding: 10px 0;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3); /* Add a subtle shadow */
        }

        /* Style the navigation links */
        nav ul {
            display: flex;
            justify-content: center;
        }

        nav li {
            margin: 0 20px; /* Add spacing between the navigation items */
        }

        nav a {
            text-decoration: none;
            color: #fff; /* White text color for links */
            padding: 10px 15px; /* Add padding for the links */
            border-radius: 5px; /* Rounded corners */
            transition: background 0.3s, transform 0.2s; /* Add smooth transition */
        }

        nav a:hover {
            background: #555; /* Darken background color on hover */
            transform: scale(1.05); /* Slight scale up on hover */
        }
        footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px 0;
    }
    </style>
</head>

<body>
    <header>
        <h1>Tutorial Site </h1>
        <nav>
            <ul>
                <li ><a href="index.php" class="anc"><i class="fa fa-home"></i> Home</a></li>
                <?php if (isset($_SESSION['user_id'])) : ?>
                <li><a href="profile.php" class="anc">My Post</a></li>
                <li><a href="post.php" class="anc"><i class="fa fa-edit"></i>  Create a post</a></li>
                <li><a href="logout.php" class="anc"> <i class="fa fa-sign-out"></i> Sign Out</a></li>
                <?php else : ?>
                <li><a href="login.php" class="anc"><i class="fa fa-sign-in"></i> Sign in</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>