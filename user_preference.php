<?php
$db = mysqli_connect('localhost', 'root', '', 'recipe');

session_start();
if (isset($_POST['submit'])) {
    $cuisines = !empty($_POST['selected_cuisines']) ? $_POST['selected_cuisines'] : null;
    $dietary_restrictions = !empty($_POST['selected_dietary']) ? $_POST['selected_dietary'] : null;
    $disliked_ingredients = !empty($_POST['selected_disliked']) ? $_POST['selected_disliked'] : null;
    $reg_id = $_SESSION['reg_id'];

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO user_preferences (reg_id, selected_cuisines, selected_dietary, selected_disliked) 
            VALUES ('$reg_id', 
                    " . ($cuisines ? "'$cuisines'" : "NULL") . ", 
                    " . ($dietary_restrictions ? "'$dietary_restrictions'" : "NULL") . ", 
                    " . ($disliked_ingredients ? "'$disliked_ingredients'" : "NULL") . ")
            ON DUPLICATE KEY UPDATE 
                selected_cuisines = " . ($cuisines ? "'$cuisines'" : "NULL") . ", 
                selected_dietary = " . ($dietary_restrictions ? "'$dietary_restrictions'" : "NULL") . ", 
                selected_disliked = " . ($disliked_ingredients ? "'$disliked_ingredients'" : "NULL");
    
    $query = mysqli_query($db, $sql);
    if ($query) {
        header('location:view_preference.php');
        exit(); // It's good practice to exit after a header redirect
    } else {
        echo "Error: " . mysqli_error($db); // Handle SQL error
    }
}

// Fetch current preferences
$reg_id = $_SESSION['reg_id'];
$query = "SELECT selected_cuisines, selected_dietary, selected_disliked FROM user_preferences WHERE reg_id='$reg_id'";
$currentPreferences = mysqli_query($db, $query);

$cuisinesSelected = [];
$dietarySelected = [];
$dislikedSelected = [];

// Initialize arrays if preferences exist
if ($currentPreferences && mysqli_num_rows($currentPreferences) > 0) {
    $current = mysqli_fetch_assoc($currentPreferences);
    $cuisinesSelected = explode(',', $current['selected_cuisines']);
    $dietarySelected = explode(',', $current['selected_dietary']);
    $dislikedSelected = explode(',', $current['selected_disliked']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Your Preferences</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .option {
            cursor: pointer;
            transition: transform 0.2s ease;
        }
        .option:hover {
            transform: scale(1.05);
        }
        .option img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }
        .selected {
            border: 3px solid #28a745;
        }
        h2, h3 {
            margin: 20px 0;
            text-align: center;
        }
        .btn-custom {
            display: block;
            width: 50%;
            margin: 20px auto;
            padding: 10px 0;
            background-color: #28a745;
            color: white;
            font-size: 1.2em;
            border: none;
            border-radius: 5px;
        }
        .btn-custom:hover {
            background-color: #218838;
        }
        .option-container {
            padding: 20px;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container text-center">
            <h1><i class="fas fa-utensils"></i> Recipe On Board</h1>
            <nav>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="search.php">Search Recipes</a></li>
                    <li><a href="UploadRecipes.php">Upload Recipes</a></li>
                    <li><a href="rating.php">View Ratings</a></li>
                    <li><a href="view_preference.php">saved preference</a></li>
                    <li><a href="index.php">Log Out</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container mt-5">
        <h2>Select Your Preferences</h2>
        <form action="" method="post" id="preferencesForm" class="form-control">
            <input type="hidden" name="selected_cuisines" value="<?php echo implode(',', $cuisinesSelected); ?>">
            <input type="hidden" name="selected_dietary" value="<?php echo implode(',', $dietarySelected); ?>">
            <input type="hidden" name="selected_disliked" value="<?php echo implode(',', $dislikedSelected); ?>">

            <h3>Cuisines</h3>
            <div class="row option-container">
                <div class="col-md-4 mb-4">
                    <div class="card option <?php echo in_array('Italian', $cuisinesSelected) ? 'selected' : ''; ?>" onclick="toggleSelection(this, 'cuisine')" data-value="Italian" data-type="cuisine">
                        <img src="img/italian.jpg" alt="Italian Cuisine" class="card-img-top">
                        <div class="card-body text-center">
                            <p class="card-text">Italian</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card option <?php echo in_array('Indian', $cuisinesSelected) ? 'selected' : ''; ?>" onclick="toggleSelection(this, 'cuisine')" data-value="Indian" data-type="cuisine">
                        <img src="img/indian.jpeg" alt="Indian Cuisine" class="card-img-top">
                        <div class="card-body text-center">
                            <p class="card-text">Indian</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card option <?php echo in_array('Turkish', $cuisinesSelected) ? 'selected' : ''; ?>" onclick="toggleSelection(this, 'cuisine')" data-value="Turkish" data-type="cuisine">
                        <img src="img/turkish.jpeg" alt="Turkish Cuisine" class="card-img-top">
                        <div class="card-body text-center">
                            <p class="card-text">Turkish</p>
                        </div>
                    </div>
                </div>
            </div>

            <h3>Dietary Restrictions</h3>
            <div class="row option-container">
                <div class="col-md-4 mb-4">
                    <div class="card option <?php echo in_array('Gluten-Free', $dietarySelected) ? 'selected' : ''; ?>" onclick="toggleSelection(this, 'dietary')" data-value="Gluten-Free" data-type="dietary">
                        <img src="img/gluten.jpg" alt="Gluten Free" class="card-img-top">
                        <div class="card-body text-center">
                            <p class="card-text">Gluten Free</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card option <?php echo in_array('Dairy-Free', $dietarySelected) ? 'selected' : ''; ?>" onclick="toggleSelection(this, 'dietary')" data-value="Dairy-Free" data-type="dietary">
                        <img src="img/dairy.jpg" alt="Dairy Free" class="card-img-top">
                        <div class="card-body text-center">
                            <p class="card-text">Dairy Free</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card option <?php echo in_array('Nut-Free', $dietarySelected) ? 'selected' : ''; ?>" onclick="toggleSelection(this, 'dietary')" data-value="Nut-Free" data-type="dietary">
                        <img src="img/nuts.avif" alt="Nut Free" class="card-img-top">
                        <div class="card-body text-center">
                            <p class="card-text">Nut Free</p>
                        </div>
                    </div>
                </div>
            </div>

            <h3>Disliked Ingredients</h3>
            <div class="row option-container">
                <div class="col-md-4 mb-4">
                    <div class="card option <?php echo in_array('Onion', $dislikedSelected) ? 'selected' : ''; ?>" onclick="toggleSelection(this, 'ingredient')" data-value="Onion" data-type="ingredient">
                        <img src="img/onion.jpg" alt="Onion" class="card-img-top">
                        <div class="card-body text-center">
                            <p class="card-text">Onion</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card option <?php echo in_array('Egg', $dislikedSelected) ? 'selected' : ''; ?>" onclick="toggleSelection(this, 'ingredient')" data-value="Egg" data-type="ingredient">
                        <img src="img/egg.jpg" alt="egg" class="card-img-top">
                        <div class="card-body text-center">
                            <p class="card-text">Egg</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card option <?php echo in_array('Tomato', $dislikedSelected) ? 'selected' : ''; ?>" onclick="toggleSelection(this, 'ingredient')" data-value="Tomato" data-type="ingredient">
                        <img src="img/tomato.jpg" alt="Tomato" class="card-img-top">
                        <div class="card-body text-center">
                            <p class="card-text">Tomato</p>
                        </div>
                    </div>
                </div>
            </div>


            <button type="submit" name="submit" class="btn btn-custom">Save Preferences</button>
        </form>
    </div>

    <script>
        function toggleSelection(card, type) {
            card.classList.toggle('selected');

            // Gather selected options for the specific type
            let selectedOptions = [];
            const options = document.querySelectorAll(`.option[data-value][data-type="${type}"]`);
            options.forEach(option => {
                if (option.classList.contains('selected')) {
                    selectedOptions.push(option.getAttribute('data-value'));
                }
            });

            // Update the hidden input field based on the type
            if (type === 'cuisine') {
                document.querySelector('input[name="selected_cuisines"]').value = selectedOptions.join(',');
            } else if (type === 'dietary') {
                document.querySelector('input[name="selected_dietary"]').value = selectedOptions.join(',');
            } else if (type === 'ingredient') {
                document.querySelector('input[name="selected_disliked"]').value = selectedOptions.join(',');
            }
        }
    </script>
</body>
</html>
