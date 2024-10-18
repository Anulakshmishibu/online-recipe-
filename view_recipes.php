<?php
// Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'recipe');

// Check if the userp_id is provided in the URL
if (isset($_GET['userp_id'])) {
    $userp_id = mysqli_real_escape_string($db, $_GET['userp_id']);

    // SQL query to fetch recipes based on user preferences from the 'user_preferences' table
    $sql = "
    SELECT recipe_id,image, cuisiens, dietary_restrictions, ingredients 
    FROM recipes 
    WHERE cuisiens = (SELECT selected_cuisines FROM user_preferences WHERE userp_id='$userp_id') 
    AND dietary_restrictions = (SELECT selected_dietary FROM user_preferences WHERE userp_id='$userp_id') 
    AND ingredients NOT LIKE CONCAT('%', (SELECT selected_disliked FROM user_preferences WHERE userp_id='$userp_id'), '%')
    ";

    // Execute the query
    $recipes = mysqli_query($db, $sql);

    // Check for query errors
    if (!$recipes) {
        die("Error executing query: " . mysqli_error($db));
    }
    
    // If no recipes match exactly, fetch suggestions based on OR condition
    if (mysqli_num_rows($recipes) == 0) {
        $suggestion_sql = "
        SELECT recipe_id,image, cuisiens, dietary_restrictions, ingredients 
        FROM recipes 
        WHERE (cuisiens = (SELECT selected_cuisines FROM user_preferences WHERE userp_id='$userp_id') 
        OR dietary_restrictions = (SELECT selected_dietary FROM user_preferences WHERE userp_id='$userp_id')) 
        AND ingredients NOT LIKE CONCAT('%', (SELECT selected_disliked FROM user_preferences WHERE userp_id='$userp_id'), '%')
        ";

        // Execute the suggestion query
        $recipes = mysqli_query($db, $suggestion_sql);
        
        // If no suggestions are found, notify the user
        if (mysqli_num_rows($recipes) == 0) {
            echo "No recipes found based on your preferences or suggestions.";
            exit;
        }
    }

} else {
    echo "User preferences not found.";
    exit;
}

// Display the fetched recipes based on the user preferences or suggestions
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <title>Recipes Based on Your Preferences</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            margin: 20px auto;
            width: 100%;
            max-width: 350px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card img {
            border-radius: 8px;
            object-fit: cover;
            height: 200px;
        }
        .card-body {
            text-align: center;
        }
        .related-section {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .related-recipes {
            max-height: 600px;
            overflow-y: auto;
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
                <li><a href="search.php">Search Recipes</a></li>
                <li><a href="UploadRecipes.php">Upload Recipes</a></li>
                <li><a href="rating.php">Rating</a></li>
                <li><a href="view_preference.php">Saved Preferences</a></li>
                <li><a href="index.php">Log out</a></li>
            </ul>
        </nav>
    </div>
</header>
<div class="container mt-5">
    <h2 class="text-center">
        <?php echo (mysqli_num_rows($recipes) > 0 && !isset($suggestion_sql)) ? 'Recipes Based on Your Preferences' : 'SUGGESTIONS'; ?>
    </h2>

    <div class="row">
        <div class="col-md-8">
            <div class="row justify-content-center">
                <?php while ($recipe = mysqli_fetch_assoc($recipes)): ?>
                    <div class="col-md-6 mb-4 d-flex justify-content-center">
                        <div class="card">
                            <img src="<?php echo $recipe['image']; ?>" class="card-img-top" alt="<?php echo $recipe['cuisiens']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $recipe['cuisiens']; ?></h5>
                                <p class="card-text">
                                    <strong>Cuisine:</strong> <?php echo $recipe['cuisiens']; ?><br>
                                    <strong>Dietary Restrictions:</strong> <?php echo $recipe['dietary_restrictions']; ?><br>
                                    <strong>Ingredients:</strong> <?php echo $recipe['ingredients']; ?>
                                </p>
                                <a href="recipes.php?recipe_id=<?php echo $recipe['recipe_id']; ?>" class="btn btn-primary">View Recipe</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <div class="col-md-4">
        <!-- <?php if ($relatedRecipes && mysqli_num_rows($relatedRecipes) > 0): ?>
                <div class="related-section">
                    <h4>Just for You</h4>
                    <div class="related-recipes">
                        <?php while ($related = mysqli_fetch_assoc($relatedRecipes)): ?>
                            <div class="card mb-3">
                                <img src="<?php echo $related['image']; ?>" class="card-img-top" alt="<?php echo $related['cuisiens']; ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $related['cuisiens']; ?></h5>
                                    <p class="card-text">
                                        <strong>Cuisine:</strong> <?php echo $related['cuisiens']; ?><br>
                                        <strong>Dietary Restrictions:</strong> <?php echo $related['dietary_restrictions']; ?><br>
                                        <strong>Ingredients:</strong> <?php echo $related['ingredients']; ?>
                                    </p>
                                    <a href="recipes.php?recipe_id=<?php echo $related['recipe_id']; ?>" class="btn btn-primary btn-sm">View Recipe</a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?> -->
        </div>
    </div>
</div>
</body>
</html>
