<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'recipe');

// Fetch user info
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
    <title>Recipe On Board</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-lQIj1Mj5rKwN2gjy5sSmLIyZBhG6KDfXJ28OG3sNv1ABuvyYb34qA6NYYA2H0V6nR29cUHhM2OZ8cFyvACRPOg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Ensure the main content adjusts accordingly */
        .recipes {
            width: 100%; /* Full width for better layout */
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* Three columns */
            grid-column-gap: 10px; /* 10px gap between cards */
            grid-row-gap: 20px; /* 20px gap below each card */
        }

        /* Style dynamic products to display properly */
        .product {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-size: 0.875rem; /* Smaller font for the content */
            padding: 10px; /* Padding for better spacing */
        }

        /* Reduce image size and maintain aspect ratio */
        .product .slider img {
            width: 100%;
            height: 200px; /* Set a fixed height for the image */
            object-fit: cover; /* Keep the image contained within the set size */
        }

        /* Responsive behavior for smaller screens */
        @media (max-width: 768px) {
            .recipes {
                grid-template-columns: repeat(2, 1fr); /* Two columns on medium screens */
            }
        }

        @media (max-width: 480px) {
            .recipes {
                grid-template-columns: 1fr; /* One card per row on mobile */
            }
        }
    </style>
</head>
<body>
<header>
    <div class="header-container">
        <h1><i class="fas fa-utensils"></i> Recipe On Board</h1>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="search.php">search Recipes</a></li>
                <li><a href="UploadRecipes.php">Upload Recipes</a></li>
                <li><a href="#">View Ratings</a></li>
                <li><a href="view_preference.php">saved preference</a></li>
                <li><a href="index.php">Log Out</a></li>
            </ul>
        </nav>
    </div>
    <div style="background-color:black;min-height:30px;">
        <p style='float:left;color:#449c3a;margin-left:10px;font-size:10px;'>You successfully logged in!</p>
        <p style='float:right;color:#fff;margin-left:px;font-size:10px;'>Welcome: <span style='margin-right:0px;display:inline-block;margin-right:5px;'><?php echo $name ?></span>
            <img src='images/user.png' style='display:inline-block;height:20px;width:20px;margin-top:5px;margin-right:5px;' />
        </p>
    </div>
</header>

<main>
    <section class="recipes">
        <h2>Product Ratings</h2>
        <div class="user-recipes-container">
            <?php
            
            $reg_id=$_SESSION['reg_id'];
            // Fetch products and ratings
            $sql = "SELECT p.recipename, p.image, r.rating, u.firstname AS username, r.created_at
                    FROM recipes p
                    INNER JOIN ratings r ON p.recipe_id = r.recipe_id
                    INNER JOIN registration u ON r.reg_id = u.reg_id
                    WHERE u.reg_id='$reg_id'";

            $result = $db->query($sql);

            if (!$result) {
                die("Query failed: " . mysqli_error($db));
            }

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product'>
                            <div class='slider'>
                                <img src='" . $row["image"] . "' alt='Product Image'>
                            </div>
                            <div class='product-info'>
                                <h3>" . $row["recipename"] . "</h3>
                                <p><strong>Rating:</strong> " . $row["rating"] . " / 5</p>
                                <p><strong>Date:</strong> " . date("F j, Y", strtotime($row["created_at"])) . "</p>
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
