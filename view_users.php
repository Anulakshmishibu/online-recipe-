<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Recipes</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .user-recipes {
            max-width: 1000px; /* Increased for horizontal layout */
            margin: auto;
            display: flex; /* Added to align items horizontally */
            flex-wrap: wrap; /* To wrap items to the next row if they overflow */
            justify-content: space-around;
        }
        .recipe-card {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 300px; /* Fixed width for consistent card size */
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .recipe-card img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
        h2 {
            color: #333;
        }
    </style>
</head>
<body>
<<header>
    <div class="header-container">
        <h1><i class="fas fa-utensils"></i> Recipe On Board</h1>
        <nav>
            <ul>
                <li><a href="admin_home.php">Home</a></li>
                <li><a href="admin_view_rating.php">View Ratings</a></li>
                <li><a href="view_users.php">view users</a></li>
                <li><a href="index.php">Log Out</a></li>
            </ul>
        </nav>
    </div>
    
</header>
<main>
    <section class="user-recipes">
        <h2>user details</h2>

        <?php
        // Connect to the database
        $db = mysqli_connect('localhost', 'root', '', 'recipe');

        // Check the database connection
        if (!$db) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Fetch user information and their uploaded recipes
        $sql = "SELECT r.recipename, u.firstname, u.lastname, r.image,r.description,r.ingredients
                FROM recipes r
                JOIN registration u ON r.reg_id = u.reg_id";

        $result = $db->query($sql);

        // Check if there are any results
        if ($result->num_rows > 0) {
            // Output data for each recipe uploaded by the user
            while ($row = $result->fetch_assoc()) {
                echo "<div class='recipe-card'>
                        <img src='" . htmlspecialchars($row["image"]) . "' alt='Recipe Image'>
                        <h3>Recipe Name: " . htmlspecialchars($row["recipename"]) . "</h3>
                        <p><strong>Uploaded by: " . htmlspecialchars($row["firstname"]) . " " . htmlspecialchars($row["lastname"]) . "</strong></p>
                        <p><strong>Ingredients:</strong> " . htmlspecialchars($row["ingredients"]) . "</p>
                        <p><strong>Description:</strong>" . htmlspecialchars($row["description"]) . "</p>
                      </div>";
            }
        } else {
            echo "<p>You have not uploaded any recipes yet.</p>";
        }

        // Close the connection
        $db->close();
        ?>
    </section>
</main>
</body>
</html>
