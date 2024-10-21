<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'recipe');

// Fetch user info for the logged-in user
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
        /* Custom star styles */
        .stars {
            font-size: 20px; /* Adjust size of stars */
        }
        .stars .full-star {
            color: gold;
        }
        .stars .half-star {
            color: gold;
        }
        .stars .empty-star {
            color: silver;
        }

        /* Grid for recipe cards */
        .recipes {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 cards per row */
            gap: 20px; /* Space between grid items */
            padding: 20px;
        }

        /* Each recipe card */
        .product {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            padding: 10px;
        }

        /* Recipe image */
        .product .slider img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }

        /* Responsive behavior for smaller screens */
        @media (max-width: 992px) {
            .recipes {
                grid-template-columns: repeat(2, 1fr); /* 2 cards per row */
            }
        }

        @media (max-width: 768px) {
            .recipes {
                grid-template-columns: repeat(1, 1fr); /* 1 card per row on small screens */
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
                <li><a href="#">View Ratings</a></li>
                <li><a href="view_users.php">view users</a></li>
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
            // Fetch the average rating for each recipe
            $sql = "SELECT p.recipename, p.image, AVG(r.rating) AS avg_rating, COUNT(r.rating) AS rating_count
                    FROM recipes p
                    LEFT JOIN ratings r ON p.recipe_id = r.recipe_id
                    GROUP BY p.recipe_id";

            $result = $db->query($sql);

            if (!$result) {
                die("Query failed: " . mysqli_error($db));
            }

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Get the average rating (rounded to 1 decimal place)
                    $avg_rating = round($row["avg_rating"], 1);

                    // Output each product card with data-rating attribute
                    echo "<div class='product'>
                            <div class='slider'>
                                <img src='" . $row["image"] . "' alt='Product Image'>
                            </div>
                            <div class='product-info'>
                                <h3>" . htmlspecialchars($row["recipename"]) . "</h3>
                                <p><strong>Rating:</strong> <span class='stars' data-rating='" . $avg_rating . "'></span> (" . $avg_rating . " / 5)</p>
                                <p><strong>Total Reviews:</strong> " . $row["rating_count"] . "</p>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all elements with the class 'stars'
        const starContainers = document.querySelectorAll('.stars');

        starContainers.forEach(container => {
            const rating = parseFloat(container.getAttribute('data-rating'));
            let starsHTML = '';
            for (let i = 1; i <= 5; i++) {
                if (i <= rating) {
                    starsHTML += '<i class="fas fa-star full-star"></i>'; // Full star
                } else if (i - rating < 1) {
                    starsHTML += '<i class="fas fa-star-half-alt half-star"></i>'; // Half star
                } else {
                    starsHTML += '<i class="far fa-star empty-star"></i>'; // Empty star
                }
            }

            container.innerHTML = starsHTML; // Set the stars
        });
    });
</script>
</body>
</html>
