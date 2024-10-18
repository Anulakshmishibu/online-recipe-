<?php
// Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'recipe');

// Start session
session_start();

// Check if the user is logged in and reg_id is set in the session
if (!isset($_SESSION['reg_id'])) {
    echo "You must be logged in to view your preferences.";
    exit;
}

// Fetch the user's preferences based on reg_id
$reg_id = mysqli_real_escape_string($db, $_SESSION['reg_id']); // Sanitize reg_id
$query = "SELECT selected_cuisines, selected_dietary, selected_disliked, userp_id FROM user_preferences WHERE reg_id='$reg_id'";
$result = mysqli_query($db, $query);

// Check if the query was successful and has results
if (!$result) {
    echo "Error fetching preferences: " . mysqli_error($db);
    exit;
}

// Close the database connection
mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Saved Preferences</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 50px;
        }
        .card {
            margin: 20px;
            padding: 20px;
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
                <li><a href="UploadRecipies.php">Upload Recipes</a></li>
                <li><a href="rating.php">Rating</a></li>
                <li><a href="view_preference.php">Saved Preference</a></li>
                <li><a href="index.php">Log out</a></li>
            </ul>
        </nav>
    </div>
</header>
<div class="container">
    <h2>Your Saved Preferences</h2>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($preferences = mysqli_fetch_assoc($result)): ?>
            <div class="card">
                <h4>Cuisines:</h4>
                <ul>
                    <?php 
                    $cuisines = !empty($preferences['selected_cuisines']) ? explode(',', $preferences['selected_cuisines']) : [];
                    if (!empty($cuisines)): 
                        foreach ($cuisines as $cuisine): ?>
                            <li><?php echo htmlspecialchars(trim($cuisine)); ?></li>
                        <?php endforeach; 
                    else: ?>
                        <li>No cuisines selected.</li>
                    <?php endif; ?>
                </ul>

                <h4>Dietary Restrictions:</h4>
                <ul>
                    <?php 
                    $dietary = !empty($preferences['selected_dietary']) ? explode(',', $preferences['selected_dietary']) : [];
                    if (!empty($dietary)): 
                        foreach ($dietary as $dietaryItem): ?>
                            <li><?php echo htmlspecialchars(trim($dietaryItem)); ?></li>
                        <?php endforeach; 
                    else: ?>
                        <li>No dietary restrictions selected.</li>
                    <?php endif; ?>
                </ul>

                <h4>Disliked Ingredients:</h4>
                <ul>
                    <?php 
                    $disliked = !empty($preferences['selected_disliked']) ? explode(',', $preferences['selected_disliked']) : [];
                    if (!empty($disliked)): 
                        foreach ($disliked as $dislikedItem): ?>
                            <li><?php echo htmlspecialchars(trim($dislikedItem)); ?></li>
                        <?php endforeach; 
                    else: ?>
                        <li>No disliked ingredients.</li>
                    <?php endif; ?>
                </ul>

                <!-- Button to view recipes based on preferences with recipe_id -->
                <a href="view_recipes.php?userp_id=<?php echo htmlspecialchars($preferences['userp_id']); ?>" class="btn btn-primary">View Recipes Based on Preferences</a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No preferences saved for this user.</p>
    <?php endif; ?>
</div>
</body>
</html>
