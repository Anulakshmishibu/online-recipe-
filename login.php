<?php
// Start the session
session_start();

// Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'recipe');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize user inputs to avoid SQL injection
    $email = mysqli_real_escape_string($db, $email);
    $password = mysqli_real_escape_string($db, $password);

    // Prepare SQL query to fetch the user with the given email, password, and usertype
    $sql = "SELECT * FROM `registration` WHERE email='$email' AND password='$password'";
    $query = mysqli_query($db, $sql);

    // Check if the query returns a result
    if (mysqli_num_rows($query) > 0) {
        // Fetch the row from the query result
        $row = mysqli_fetch_assoc($query);

        // Set the session with the user's reg_id and usertype
        $_SESSION['reg_id'] = $row['reg_id'];
        $_SESSION['usertype'] = $row['usertype'];

        // Redirect based on usertype
        if ($row['usertype'] == 'admin') {
            header('Location: admin_home.php'); // Redirect to the admin home page
        } elseif ($row['usertype'] == 'user') {
            header('Location: home.php'); // Redirect to the user home page
        } else {
            echo "<script>alert('Invalid user type');</script>";
        }
        exit();
    } else {
        echo "<script>alert('Invalid email or password');</script>";
    }
}
?>
!-- HTML part to display message -->
<?php if (isset($message)) { echo "<p>$message</p>"; } ?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Login - Recipe Sharing System</title>
    <link rel="stylesheet" href="styles.css">
    <script defer src="login.js"></script>
</head>
<body>
    <body class="login-body">
    <header>
        <div class="header-container">
            <h1><i class="fas fa-utensils"></i>Recipe On Board</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="login.php">Recipes</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="login.php">Upload Recipes</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="register.php">Register</a></li>
                    <li><a href="login.php">Log In</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <section class="login-form">
            <h2>Log In</h2>
            <form id="loginForm" action=" " method="post">
                <div class="form-group">
                    <table>
                        <tr>
                            <th>Email</th>
                            <td><input type="email" name="email" class="form-control"required></td>
                        </tr>
                    </table>
                </div>
                <div class="form-group">
                    <table>
                    <tr>
                        <th>Password</th>
                        <td><input type="password" name="password" class="form-control" required></td>
                    </tr>
                    </table>
                </div>
                <button type="submit" class="btn" name="submit">Log In</button>
                <a href="register.php">new user</a>
            </form>
        </section>
    </main>

</body>
</html>
