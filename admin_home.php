<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'recipe');

$sql = "SELECT * FROM registration WHERE reg_id='" . $_SESSION["reg_id"] . "'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_array($result);
$name = $row['firstname'];

if ($_SESSION["reg_id"] == 0) {
    $none = 'none';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        /* Ensure the main content adjusts accordingly */
/* Ensure the main content adjusts accordingly */
        main {
            display: grid;
            grid-template-columns: 1fr 3fr; /* Two columns: sidebar 1fr, main content 3fr */
            gap: 20px;
        }

        /* Sidebar styling */
        .sidebar {
            display: flex;
            width: 100%;
            height: 350px;
           
        }
        .sidebar.preferences-card.recipe .slider img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        /* Preferences button card style */
        .preferences-card {
            background-color: #f9f9f9;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }

        .preferences-card h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .preferences-card a {
            display: inline-block;
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .preferences-card a:hover {
            background-color: #45a049;
        }

        .recipes {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); /* Automatically fit as many columns as possible */
            gap: 1rem; /* Smaller gap for more compact design */
        }

        /* Style dynamic recipes to display horizontally */
        .recipe {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        
            font-size: 0.875rem; /* Smaller font for the content */
        }

        /* Reduce image size and maintain aspect ratio */
        .recipe .slider img {
            width: 100%;
            height: 150px; /* Set a fixed height for the image */
            object-fit: cover; /* Keep the image contained within the set size */
        }

        /* Responsive behavior for smaller screens */
        @media (max-width: 768px) {
            .recipes {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); /* Adjust for smaller screens */
            }
        }

        @media (max-width: 480px) {
            .recipes {
                grid-template-columns: 1fr; /* One card per row on mobile */
            }
        }

    </style>
    <title>Recipe On Board</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-lQIj1Mj5rKwN2gjy5sSmLIyZBhG6KDfXJ28OG3sNv1ABuvyYb34qA6NYYA2H0V6nR29cUHhM2OZ8cFyvACRPOg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<header>
    <div class="header-container">
        <h1><i class="fas fa-utensils"></i> Recipe On Board</h1>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="admin_view_rating.php">View Ratings</a></li>
                <li><a href="view_users.php">view users</a></li>
                <li><a href="index.php">Log Out</a></li>
            </ul>
        </nav>
    </div>
    <div style="background-color:black;min-height:30px;">
        <p style='float:left;color:#449c3a;margin-left:10px;font-size:10px;'>You successfully logged in!</p>
        <p style='float:right;color:#fff;margin-left:px;font-size:10px;'>Welcome: <span style='margin-right:0px;display:inline-block;margin-right:5px;'><?php echo $name ?></span>
            <img src='img/user.png' style='display:inline-block;height:20px;width:20px;margin-top:5px;margin-right:5px;' />
        </p>
    </div>
</header>
<body>
<main>
    <aside class="sidebar">
            <div class="preferences-card">
                <div class="recipe">
                <div class="slider">
                    <img src="img/food1.avif" alt="" >
                    <img src="img/food2.avif" alt="" >
                    <img src="img/food3.avif" alt="">
                    
                </div>
                <a href="user_preference.php">Personalize your cuisines</a>
            </div>
        </aside>
    <section class="recipes">
        <h2>Featured Recipes</h2>
        <div class="user-recipes-container">
            <?php
            $db = mysqli_connect('localhost', 'root', '', 'recipe');

            if (!$db) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT * FROM recipes INNER JOIN registration USING (reg_id)";
            $result = $db->query($sql);

            if (!$result) {
                die("Query failed: " . mysqli_error($db));
            }

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='recipe'>
                            <div class='slider'>
                                <img src='" . $row["image"] . "' alt='Recipe Image'>
                            </div>
                            <div class='recipe-info'>
                                <h3>" . $row["recipename"] . "</h3>
                                <p><strong>By:</strong> " . $row["firstname"] . "</p>
                                <p>" . $row["description"] . "</p>
                                <a href='recipes.php?recipe_id=" . $row['recipe_id'] . "' class='btn'>View Recipe</a>
                            </div>
                          </div>";
                }
            } else {
                echo "No results found.";
            }
            $db->close();
            ?>
        </div>
    </section>
</main>

<script src="scripts.js"></script>
</body>
</html>
