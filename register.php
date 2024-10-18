<?php
$db=mysqli_connect('localhost','root','','recipe');
  

if(isset($_POST['submit']))
{
	$fname=$_POST['firstname'];
	$lname=$_POST['lastname'];
	$email=$_POST['email'];	
	$password=$_POST['password'];
			
			
			
	$sql = "INSERT INTO `registration`(firstname,lastname,email,password) VALUES('$fname','$lname','$email','$password')";
	$query=mysqli_query($db, $sql);
	if($query)
	{
		header('location:signup_success.php');
	}
	
	

}
 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Recipe Sharing System</title>
    <link rel="stylesheet" href="styles.css">
    <script defer src="login.js"></script>
</head>
<body>
    <body class="login-body">
    <header>
        <div class="header-container">
            <h1><i class="fas fa-utensils"></i> Recipe Sharing System</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="recipes.html">Recipes</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="login.php">Upload Recipes</a></li>
                    <li><a href="contact.html">Contact</a></li>
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
                            <th>Firstname</th>
                            <td><input type="text" name="firstname" required></td>
                        </tr>
                    </table>
                </div>
                <div class="form-group">
                    <table>
                        <tr>
                            <th>Lastname</th>
                            <td><input type="text" name="lastname" required></td>
                        </tr>
                    </table>
                </div>
                <div class="form-group">
                    <table>
                        <tr>
                            <th>email</th>
                            <td><input type="email" name="email" required></td>
                        </tr>
                    </table>
                </div>
                <div class="form-group">
                    <table>
                    <tr>
                        <th>Password</th>
                        <td><input type="password" name="password" required></td>
                    </tr>
                    </table>
                </div>
                <button type="submit" class="btn" name="submit">Log In</button>
            </form>
        </section>
    </main>

</body>
</html>
