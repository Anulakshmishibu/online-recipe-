<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Search</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <style>
        /* Main layout */
        .main-container {
            display: flex;
            gap: 20px; /* Space between card and reviews */
            max-width: 1200px; /* Max width for the main container */
            margin: auto; /* Center the container */
        }

        /* Style for the recipe card */
        .recipe {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-size: 0.875rem;
            width: 600px; /* Fixed width for recipe card */
        }

        .recipe .slider img {
            width: 100%;
            height: 400px; /* Set height of the image */
            object-fit: cover;
        }

        .recipe-info {
            padding: 15px;
            text-align: justify;
            text-align: center;
        }

        .recipe-info h3 {
            margin: 0;
            font-size: 1.25rem;
            text-align: center;
            color: #333;
        }

        /* Star rating section */
        .rating {
            display: flex;
            justify-content: center;
            margin-top: 15px;
        }

        .rating i {
            font-size: 24px;
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s;
        }

        .rating i.selected,
        .rating i:hover,
        .rating i:hover ~ i {
            color: #ffcc00;
        }

        /* Review Form */
        textarea {
            width: 100%;
            height: 80px;
            padding: 10px;
            margin-top: 10px;
        }

        button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }

        /* Review Section */
        .reviews {
            margin-top: 20px;
            background: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            width: 300px; /* Fixed width for reviews */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .review {
            background: #fff;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .review p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
<header>
    <div class="header-container">
        <h1><i class="fas fa-utensils"></i> Recipe Search</h1>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="#">Recipes</a></li>
                <li><a href="UploadRecipes.php">Upload Recipes</a></li>
                <li><a href="view_preference.php">saved preference</a></li>
                <li><a href="index.html">Log out</a></li>
            </ul>
        </nav>
    </div>
</header>
<main>
    <section class="recipes">
        <h2> Recipe Details </h2>
        
        <div class="main-container">
            <div class="user-recipes-container">
                <?php
                session_start();
                $recipe_id = $_GET['recipe_id']; 
                
                $db = mysqli_connect('localhost', 'root', '', 'recipe');

                // Check the database connection
                if (!$db) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Fetch recipe_id from URL
                

                
                $sql = "SELECT * FROM recipes WHERE recipe_id = '$recipe_id'";

                $result = $db->query($sql);

                // Check if the query was successful
                if ($result->num_rows > 0) {
                    // Output data of each row in the same card format as static recipes
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='recipe'>
                                <div class='slider'>
                                    <img src='" . $row["image"] . "' alt='Recipe Image'>
                                </div>
                                <div class='recipe-info'>
                                    <h3>" . $row["recipename"] . "</h3>
                                    <p>" . $row["description"] . "</p>
                                    <strong>Ingredients</strong>
                                    <p>" . $row["ingredients"] . "</p>
                                    <strong>Directions</strong>
                                    <p>" . $row["directions"] . "</p>

                                    <!-- Star Rating Section -->
                                    <div class='rating'>
                                        <i class='fas fa-star' data-value='1'></i>
                                        <i class='fas fa-star' data-value='2'></i>
                                        <i class='fas fa-star' data-value='3'></i>
                                        <i class='fas fa-star' data-value='4'></i>
                                        <i class='fas fa-star' data-value='5'></i>
                                    </div>

                                    <!-- Review Form -->
                                    <form action='' method='POST'>
                                        <input type='hidden' name='recipe_id' value='$recipe_id'>
                                        <input type='hidden' id='rating' name='rating' value='0'>
                                        <textarea name='review_text' placeholder='Write your review here...' required></textarea>
                                        <button type='submit'>Submit Review</button>
                                    </form>
                                </div>
                              </div>";
                    }
                } else {
                    echo "No results found.";
                }

                // Handle review form submission
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $rating = $_POST['rating'];
                    $review_text = mysqli_real_escape_string($db, $_POST['review_text']);
                    $reg_id = $_SESSION['reg_id'];
                    
                    // Insert the review into the ratings table
                    $insert_sql = "INSERT INTO ratings (recipe_id, reg_id, rating, review_text, created_at)
                                   VALUES ('$recipe_id','$reg_id', '$rating', '$review_text', NOW())";

                    if (mysqli_query($db, $insert_sql)) {
                        echo "<p>Review submitted successfully!</p>";
                    } else {
                        echo "Error: " . $insert_sql . "<br>" . mysqli_error($db);
                    }
                }

                // Close the connection
                $db->close();
                ?>
            </div>

            <!-- Reviews Section -->
            <div class='reviews'>
                <h3>Previous Reviews:</h3>
                <?php
                // Reconnect to the database to fetch previous reviews
                $db = mysqli_connect('localhost', 'root', '', 'recipe');
                $review_sql = "SELECT * FROM ratings WHERE recipe_id = '$recipe_id' ORDER BY created_at DESC";
                $review_result = $db->query($review_sql);

                if ($review_result->num_rows > 0) {
                    while ($review_row = $review_result->fetch_assoc()) {
                        // Display stars based on the rating
                        $rating = $review_row["rating"];
                        echo "<div class='review'>
                                <p><strong>Rating:</strong></p>
                                <div class='rating'>";
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $rating) {
                                echo "<i class='fas fa-star selected'></i>";
                            } else {
                                echo "<i class='fas fa-star'></i>";
                            }
                        }
                        echo "</div>
                                <p><strong>Review:</strong> " . $review_row["review_text"] . "</p>
                                <p><strong>Date:</strong> " . $review_row["created_at"] . "</p>
                              </div>";
                    }
                } else {
                    echo "<p>No reviews yet. Be the first to review!</p>";
                }
                ?>
            </div>
        </div>
    </section>
</main>

<script>
    // JavaScript to handle the star rating interaction
    const stars = document.querySelectorAll('.rating i');
    const ratingInput = document.getElementById('rating');

    stars.forEach(star => {
        star.addEventListener('click', function() {
            const value = this.getAttribute('data-value');
            clearSelection();
            selectStars(value);
            ratingInput.value = value; // Set the selected rating in the hidden input
        });
    });

    function clearSelection() {
        stars.forEach(star => {
            star.classList.remove('selected');
        });
    }

    function selectStars(value) {
        for (let i = 0; i < value; i++) {
            stars[i].classList.add('selected');
        }
    }
</script>
</body>
</html>
